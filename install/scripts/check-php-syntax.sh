find ./ -type f -name \*.php -exec php -l {} \; | grep -v "No syntax errors"
find ./ -type f -name \*.inc -exec php -l {} \; | grep -v "No syntax errors"

