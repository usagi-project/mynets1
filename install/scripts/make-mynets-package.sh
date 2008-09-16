#!/bin/sh

# 2007/06/28  Kenji Suzuki
# 2008/08/26  KUNIHARU Tsujioka path update


url_release="http://svn.usagi-project.org/svn2/public/tags/"
url_test="http://svn.usagi-project.org/svn2/public/"
dir="Usagi"


url="$url_release"

if [ $# -eq 0 ]; then
    echo "Make MyNETS package"
    echo
    echo " official release package from tag"
    echo " usage: $0 tag"
    echo "    eg: $0 1.1.0Nighty-20070627"
    echo
    echo " test package from trunk"
    echo " usage: $0 version test"
    echo "    eg: $0 1.2.0Nighty-20080430 test"
    exit;
fi

tag=$1
version=$1
package="MyNETS-$tag"


if [ "$2" == "test" ]; then
    url="$url_test"
    tag="trunk"
    version="$version-test"
    package="$package-test"
fi


echo "Exporting $url$tag"
rm -rf $dir
svn export -q "$url$tag" "$dir"

if [ $? -ne 0 ]; then
    echo "Export Error!"
    exit 1;
fi


if [ "$2" == "test" ]; then
    echo "Update version in version.php: $version "
    sed "s/, '.*'/, '$version'/" $dir/webapp/version.php > version.php.$$
    mv version.php.$$ $dir/webapp/version.php
fi


echo "Making sql files for installer"
cd $dir
sh ../create-sql-for-installer.sh

echo "Removing install/scripts directory"
rm -rf install/scripts
 
echo "Making md5 data file"
cd install
php check-file-get-md5.php

echo "Checking CRLF"
cd ..
php ../check-crlf.php

echo "Checking PHP syntax"
sh ../check-php-syntax.sh

cd ..
rm -f $package.tar.gz $package.tar.bz2 $package.zip

echo "Making package: $package.tar.gz"
tar zcf $package.tar.gz $dir

echo "Making package: $package.tar.bz2"
tar jcf $package.tar.bz2 $dir

echo "Making package: $package.zip"
zip -rq $package.zip $dir

md5sum $package.*

