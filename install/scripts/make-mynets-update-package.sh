#!/bin/sh

# 2007/06/29  Kenji Suzuki


if [ $# -ne 2 ]; then
    echo "Make MyNETS update package"
    echo " usage: $0 old_package new_package"
    echo "    eg: $0 MyNETS-1.1.0Nighty-20070627.zip MyNETS-1.1.0Nighty-20070628.zip"
    exit;
fi


old=$1
new=$2

old_dir=`echo ${old%.zip}`
new_dir="Usagi"

new_version=`echo ${new%.zip}`

is_old_nighty=`echo $old_dir | grep Nighty | wc -l`
is_new_nighty=`echo $new_version | grep Nighty | wc -l`
nighty_to_official=0

if [ $is_old_nighty -eq 1 ];
then
    if [ $is_new_nighty -eq 0 ];
    then
        nighty_to_official=1
    fi
fi

if [ $nighty_to_official -eq 0 ];
then
    length=`echo ${#new_version}`
    from=`expr $length - 7`
    new_date=`echo $new_version | cut -c $from-$lenght`
else
    new_date=`echo $new_version | sed s/MyNETS-//`
fi

rm -rf Usagi $old_dir $new_dir

if [ -f $old ]; then
    unzip -q $old
    mv Usagi $old_dir
else
    echo "No such file: $old"
    exit 1
fi
if [ -f $new ]; then
    unzip -q $new
    #mv Usagi $new_dir
else
    echo "No such file: $new"
    exit 1
fi

export LANG=C
zip ${old_dir}to${new_date}.zip `diff -rN $old_dir Usagi | grep ^diff | cut -f 4 -d ' '`

diff=`diff -rN $old_dir Usagi | grep ^Binary | wc -l`
if [ $diff -ne 0 ];
then 
    zip ${old_dir}to${new_date}.zip `diff -rN $old_dir Usagi | grep ^Binary | cut -f 5 -d ' '`
fi

