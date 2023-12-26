# Carservice Admin 本地 Docker 开发环境

## 使用方式
1. `docker-compose up -d 或 docker-compose -f docker-compose.yaml up -d`
2. `运行 PHP 命令: docker exec -it admin-dev-php bash`
3. `运行 MYSQL 命令: docker exec -it admin-dev-mysql bash`

## 开启 Laravel Admin HTTP 服务
```bash
# 进入 PHP 容器的命令行模式
docker exec -it admin-dev-php bash
# 开启服务器
php artisan serve

```
## 使用 MYSQL 终端
```bash
# 进入 MYSQL 容器的命令模式
docker exec -it admin-dev-mysql bash
# 进入数据库
mysql -u YOUR_USERNAME -p YOUR_PASSWORD
```