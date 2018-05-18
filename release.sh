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
echo "  Github to WordPress.org Auto Load Next Post Release  "
echo "-------------------------------------------------------"
read -p "TAG AND RELEASE VERSION: " VERSION
echo "-------------------------------------------------------"
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

echo "-------------------------------------------------------"
echo "Did you tag a beta or a release candidate last?"
read -p "Enter Y for Yes or N for No "${BETA}""
echo "-------------------------------------------------------"
clear

# Check if version is already released.
if ${BETA} = 'n' && $ROOT_PATH git show-ref --tags --exclude-existing | egrep -q "refs/tags/v${VERSION}"
then
	echo "-------------------------------------------------------"
	echo "Version already tagged and released.";
	echo ""
	echo "Run sh release.sh again and enter another version.";
	echo "-------------------------------------------------------"
	exit 1;
else
	echo "-------------------------------------------------------"
	echo "v${VERSION} has not been found released. Now processing...";
	echo "-------------------------------------------------------"
fi

# DELETE OLD TEMP DIRS
rm -Rf $ROOT_PATH$TEMP_GITHUB_REPO

# CHECKOUT SVN DIR IF NOT EXISTS
if [[ ! -d $TEMP_SVN_REPO ]];
then
	echo "Checking out WordPress.org plugin repository"
	echo "-------------------------------------------------------"
	svn checkout $SVN_REPO $TEMP_SVN_REPO || { echo "Unable to checkout repo."; exit 1; }
fi

clear

# CLONE GIT DIR
echo "Cloning GIT repository from GitHub.com"
git clone --progress $GIT_REPO $TEMP_GITHUB_REPO || { echo "Unable to clone repo."; exit 1; }

# MOVE INTO GIT DIR
cd $ROOT_PATH$TEMP_GITHUB_REPO

# Update local tags just incase.
clear
echo "Fetching remote tags to update locally."
git fetch --tags

# LIST BRANCHES
clear
git fetch origin
echo "-------------------------------------------------------"
echo "Which branch do you wish to release?"
git branch -r || { echo "Unable to list branches."; exit 1; }
echo ""
read -p "origin/" BRANCH

# Switch Branch
echo ""
echo "Switching to branch"
git checkout ${BRANCH} || { echo "Unable to checkout branch."; exit 1; }

echo ""
read -p "Press [ENTER] to deploy branch "${BRANCH}

# REMOVE UNWANTED FILES & FOLDERS
echo ""
echo "Removing unwanted files"
rm -RF .wordpress-org
rm -Rf .git
rm -Rf .github
rm -Rf tests
rm -Rf apigen
rm -Rf screenshots
rm -f .gitattributes
rm -f .gitignore
rm -f .gitmodules
rm -f Gruntfile.js
rm -f .jscrsrc
rm -f .jshintrc
rm -f phpunit.xml.dist
rm -f .editorconfig
rm -f apigen.neon
rm -f *.json
rm -f *.yml
rm -f *.xml
rm -f *.md
rm -f *.png
rm -f *.sh

# MOVE INTO SVN DIR
cd "../"$TEMP_SVN_REPO

# UPDATE SVN
echo ""
echo "Updating SVN"
svn update || { echo "Unable to update SVN."; exit 1; }

# DELETE TRUNK
echo ""
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
echo ""
echo "Copying trunk to new tag"
svn copy trunk tags/${VERSION} || { echo "Unable to create tag."; exit 1; }

# DO SVN COMMIT
clear
echo "Show SVN status"
svn status

# PROMPT USER
echo ""
read -p "Press [ENTER] to commit release "${VERSION}" to WordPress.org AND GitHub."
echo ""

# CREATE THE GITHUB RELEASE
echo "Creating release on GITHUB repository."
cd "$GITPATH"

echo ""
echo "Tagging new version in git"
git tag -a "v${VERSION}" -m "Tagging version v${VERSION}"

echo ""
echo "Pushing latest commit to origin, with tags"
git push origin master
git push origin master --tags

# DEPLOY
echo ""
echo "Committing to WordPress.org... this may take a while..."
svn commit -m "Releasing "${VERSION}"" || { echo "Unable to commit."; exit 1; }

# REMOVE THE TEMP DIRS
echo ""
echo "Cleaning Up..."
cd "../"
rm -Rf $ROOT_PATH$TEMP_GITHUB_REPO
rm -Rf $ROOT_PATH$TEMP_SVN_REPO

# DONE
echo ""
echo "Release Done."
echo ""
read -p "Press [ENTER] to close program."
clear
