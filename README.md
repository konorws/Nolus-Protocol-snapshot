Example: http://65.109.3.210/

# Install and config

```bash
git clone https://github.com/konorws/Nolus-Protocol-snapshot.git .
composer install
```

## Config
1. Set URI in public/index.php
2. Configure cronjob for run
```bash
sh <PROJECT FOLDER>/script/download.sh <PROJECT FOLDER>/script/ && cd ../ && php ./update_time.php
```
