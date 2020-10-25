## 升級composer2
composer self-update --2
退回版本
composer self-update --rollback


## 安裝tailwind

安裝
> yarn add tailwindcss postcss-cli autoprefixer

設定檔
> npx tailwindcss init --full

> npm install @fullhuman/postcss-purgecss

建立postcss.config.js檔

修改package.json

打包方式(參照package.json)
1. yarn build 極致打包(只有包用到的class)
2. yarn prod 打包tailwind所有css(容量很大)

## Vue安裝

composer require laravel/ui "^2.0"

php artisan ui vue --auth

建立model controller migrate
php artisan make:model Todo -mcr

## Vue-route安裝
npm install vue-router

## route列表

|功能|路徑|
|---|---|
|todo list (vue)|/todo|