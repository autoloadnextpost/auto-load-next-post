#!/bin/sh

# The slug of your WordPress.org plugin
PLUGIN_SLUG="auto-load-next-post"

# GITHUB user who owns the repo
GITHUB_REPO_OWNER="seb86"

# GITHUB Repository name
GITHUB_REPO_NAME="Auto-Load-Next-Post"

set -e
clear

# ASK INFO
echo "-------------------------------------------------------"
echo "     Auto Load Next Post Manually Merge Conflicts"
echo "-------------------------------------------------------"
echo ""
echo "Before continuing, confirm that you have done the following :)"
echo ""
read -p " - Added a changelog?"
read -p " - Updated the POT file?"
read -p " - Committed all changes up to GITHUB?"
echo ""
read -p "Press [ENTER] to Merge."
clear

# VARS
ROOT_PATH=""
TEMP_GITHUB_REPO=${PLUGIN_SLUG}"-git"
GIT_REPO="https://github.com/"${GITHUB_REPO_OWNER}"/"${GITHUB_REPO_NAME}".git"

# DELETE OLD TEMP DIRS
rm -Rf $ROOT_PATH$TEMP_GITHUB_REPO

# CLONE GIT DIR
echo "Cloning GIT repository from GITHUB"
git clone --progress $GIT_REPO $TEMP_GITHUB_REPO || { echo "Unable to clone repo."; exit 1; }

# MOVE INTO GIT DIR
cd $ROOT_PATH$TEMP_GITHUB_REPO

# LIST BRANCHES
clear
git fetch origin
echo "Which branch do you wish to merge from?"
git branch -r || { echo "Unable to list branches."; exit 1; }
echo ""
read -p "origin/" BRANCH

# Switch Branch
echo "Switching to branch"
git checkout ${BRANCH} || { echo "Unable to checkout branch."; exit 1; }

echo ""
read -p "Press [ENTER] to deploy branch "${BRANCH}

# CREATE THE GITHUB RELEASE
echo "Creating release on GITHUB repository."
cd "$GITPATH"

echo "Tagging new version in git"
git tag -a "v${VERSION}" -m "Tagging version v${VERSION}"

echo "Pushing latest commit to origin, with tags"
git push origin master
git push origin master --tags

# REMOVE THE TEMP DIRS
echo "Cleaning Up..."
cd "../"
rm -Rf $ROOT_PATH$TEMP_GITHUB_REPO

# DONE
echo "Release Done."
echo ""
read -p "Press [ENTER] to close program."
echo ""
clear
