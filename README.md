
#Information
* Introduction: This is the project of 2013 Data Mining and Cloud Programming class.
* Author: Patrick Lee, Veck Hsiao, Nick Cheng, Weng Chih Tseng @ PLSM Lab, NCCU, Taipei, Taiwan
* Last update: 2014/01/21 18:13

#File Structure
```
.
├── admin.css
├── Admin.php
├── arff
│   ├── bootstrap
│   │   ├── css
│   │   │   ├── bootstrap.css
│   │   │   ├── bootstrap.min.css
│   │   │   ├── bootstrap-theme.css
│   │   │   └── bootstrap-theme.min.css
│   │   ├── fonts
│   │   │   ├── glyphicons-halflings-regular.eot
│   │   │   ├── glyphicons-halflings-regular.svg
│   │   │   ├── glyphicons-halflings-regular.ttf
│   │   │   └── glyphicons-halflings-regular.woff
│   │   └── js
│   │       ├── bootstrap.js
│   │       └── bootstrap.min.js
│   └── display.php
├── deploy.sql
├── index.css
├── index.php
├── models
│   ├── changhwa.model
│   ├── chiayi_city.model
│   ├── chiayi_county.model
│   ├── hsinchu_city.model
│   ├── hsinchu_county.model
│   ├── hualien.model
│   ├── jinmen.model
│   ├── kaohsiung_city.model
│   ├── kaohsiung_county.model
│   ├── keelong.model
│   ├── lienjun.model
│   ├── miaoli.model
│   ├── nantou.model
│   ├── new_taipei.model
│   ├── pintung.model
│   ├── ponghu.model
│   ├── taichung_city.model
│   ├── taichung_county.model
│   ├── tainan_city.model
│   ├── tainan_county.model
│   ├── taipei.model
│   ├── taitung.model
│   ├── taoyuan.model
│   ├── yilan.model
│   └── yunlin.model
├── multiple_sample.arff
├── PLSM.ico
├── PLSM.png
├── Readme
├── result.php
├── single_sample.arff
├── sql_config.php
└── weka.jar
```

#Note
* `models` are pre-constructed for data mining.
* Remember to configure your MySQL database with `deploy.sql` and `sql_config.php`.

#Issuse
* `result.php` and `display.php` should change GET method to POST method to avoid information leak (output*****.txt).
* `admin.php` should complete database update function.
* `admin.php` should output the latest result of learning (re-mining after update database).
* Some fields of typhoon data should be discretized.
* The interface allows user inserting new county should be drop-down list instead of textbox.
* Folder `arff` could be remove, but path in `result.php` and `display.php` should be modified.
* File structure shold be rearranged.
