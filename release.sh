#!/bin/sh

# ----- START EDITING HERE -----

# THE GITHUB ACCESS TOKEN, GENERATE ONE AT: https://github.com/settings/tokens
# GITHUB_ACCESS_TOKEN="TOKEN"

# The slug of your WordPress.org plugin
PLUGIN_SLUG="auto-load-next-post"

# GITHUB user who owns the repo
GITHUB_REPO_OWNER="seb86"

# GITHUB Repository name
GITHUB_REPO_NAME="Auto-Load-Next-Post"

# ----- STOP EDITING HERE -----

set -e
clear

# ASK INFO
echo "--------------------------------------------"
echo "      Github to WordPress.org RELEASER      "
echo "--------------------------------------------"
read -p "TAG AND RELEASE VERSION: " VERSION
echo "--------------------------------------------"
echo ""
echo "Before continuing, confirm that you have done the following :)"
echo ""
read -p " - Added a changelog for "${VERSION}"?"
read -p " - Set version in the readme.txt and main file to "${VERSION}"?"
read -p " - Set stable tag in the readme.txt file to "${VERSION}"?"
read -p " - Updated the POT file?"
read -p " - Committed all changes up to GITHUB?"
echo ""
read -p "Press [ENTER] to begin releasing "${VERSION}
clear

# VARS
ROOT_PATH=""
TEMP_GITHUB_REPO=${PLUGIN_SLUG}"-git"
TEMP_SVN_REPO=${PLUGIN_SLUG}"-svn"
SVN_REPO="https://plugins.svn.wordpress.org/"${PLUGIN_SLUG}"/"
GIT_REPO="https://github.com/"${GITHUB_REPO_OWNER}"/"${GITHUB_REPO_NAME}".git"

# Check if version is already released.
if $ROOT_PATH git show-ref --tags | egrep -q "refs/tags/v${VERSION}"
then
	echo "Version already tagged and released.";
	echo ""
	echo "Run sh release.sh again and enter another version.";
	exit 1;
else
	echo ""
	read -p "v${VERSION} has not been found released. Press [ENTER] to continue."; exit 1;
fi

# DELETE OLD TEMP DIRS
rm -Rf $ROOT_PATH$TEMP_GITHUB_REPO

# CHECKOUT SVN DIR IF NOT EXISTS
if [[ ! -d $TEMP_SVN_REPO ]];
then
	echo "Checking out WordPress.org plugin repository"
	svn checkout $SVN_REPO $TEMP_SVN_REPO || { echo "Unable to checkout repo."; exit 1; }
fi

# CLONE GIT DIR
echo "Cloning GIT repository from GITHUB"
git clone --progress $GIT_REPO $TEMP_GITHUB_REPO || { echo "Unable to clone repo."; exit 1; }

# MOVE INTO GIT DIR
cd $ROOT_PATH$TEMP_GITHUB_REPO

# LIST BRANCHES
clear
git fetch origin
echo "Which branch do you wish to release?"
git branch -r || { echo "Unable to list branches."; exit 1; }
echo ""
read -p "origin/" BRANCH

# Switch Branch
echo "Switching to branch"
git checkout ${BRANCH} || { echo "Unable to checkout branch."; exit 1; }

echo ""
read -p "Press [ENTER] to deploy branch "${BRANCH}

# REMOVE UNWANTED FILES & FOLDERS
echo "Removing unwanted files"
rm -Rf .git
rm -Rf .github
rm -Rf tests
rm -Rf apigen
rm -f .gitattributes
rm -f .gitignore
rm -f .gitmodules
rm -f .travis.yml
rm -f Gruntfile.js
rm -f package.json
rm -f .jscrsrc
rm -f .jshintrc
rm -f composer.json
rm -f phpunit.xml
rm -f phpunit.xml.dist
rm -f README.md
rm -f .coveralls.yml
rm -f .editorconfig
rm -f .scrutinizer.yml
rm -f apigen.neon
rm -f CHANGELOG.txt
rm -f CONTRIBUTING.md
rm -f Theme-Presets.md
rm -f screenshot-*.png
rm -f release.sh

# MOVE INTO SVN DIR
cd "../"$TEMP_SVN_REPO

# UPDATE SVN
echo "Updating SVN"
svn update || { echo "Unable to update SVN."; exit 1; }

# DELETE TRUNK
echo "Replacing trunk"
rm -Rf trunk/

# COPY GIT DIR TO TRUNK
cp -R "../"$TEMP_GITHUB_REPO trunk/

# DO THE ADD ALL NOT KNOWN FILES UNIX COMMAND
svn add --force * --auto-props --parents --depth infinity -q

# DO THE REMOVE ALL DELETED FILES UNIX COMMAND
MISSING_PATHS=$( svn status | sed -e '/^!/!d' -e 's/^!//' )

# iterate over filepaths
for MISSING_PATH in $MISSING_PATHS; do
    svn rm --force "$MISSING_PATH"
done

# COPY TRUNK TO TAGS/$VERSION
echo "Copying trunk to new tag"
svn copy trunk tags/${VERSION} || { echo "Unable to create tag."; exit 1; }

# DO SVN COMMIT
clear
echo "Showing SVN status"
svn status

# PROMPT USER
echo ""
read -p "Press [ENTER] to commit release "${VERSION}" to WordPress.org AND GITHUB"
echo ""

# CREATE THE GITHUB RELEASE
echo "Creating release on GITHUB repository."
#API_JSON=$(printf '{ "tag_name": "%s","target_commitish": "%s","name": "%s", "body": "Release of version %s", "draft": false, "prerelease": false }' $VERSION $BRANCH $VERSION $VERSION)
#RESULT=$(curl --data "${API_JSON}" https://api.github.com/repos/${GITHUB_REPO_OWNER}/${GITHUB_REPO_NAME}/releases?access_token=${GITHUB_ACCESS_TOKEN})
cd "$GITPATH"
#git commit -m "Releasing version ${VERSION}"

echo "Tagging new version in git"
git tag -a "v${VERSION}" -m "Tagging version v${VERSION}"

echo "Pushing latest commit to origin, with tags"
git push origin master
git push origin master --tags

# DEPLOY
echo ""
echo "Committing to WordPress.org... this may take a while..."
svn commit -m "Releasing "${VERSION}"" || { echo "Unable to commit."; exit 1; }

# REMOVE THE TEMP DIRS
echo "Cleaning Up..."
rm -Rf $ROOT_PATH$TEMP_GITHUB_REPO
rm -Rf $ROOT_PATH$TEMP_SVN_REPO

# DONE
echo "Release Done."
echo ""
read -p "Press [ENTER] to close program."
echo ""

clear

echo "END OF LINE!"
