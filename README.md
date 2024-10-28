
# Database Optimization

## Question 1:
```sql
SELECT bnb_id,bnbs.name as 'bnb_name',sum(amount) as 'may_amount' FROM orders join bnbs on bnbs.id = orders.bnb_id WHERE check_in_date >= '2023-05-01' and check_out_date <= '2023-05-31' and currency='TWD' GROUP BY bnb_id order By `may_amount` limit 10;
```
1.只拿取需要的欄位，以減少讀取的資料量。
2.避免在where中使用函數。

## Question 2:
1.考慮將資料分表，例如以日期分表，或是將太舊的資料搬到其他表封存，以減少查詢時間。
2.使用explain分析sql語法，確認效能瓶頸。
3.確認orders上面的bnb_id有建立索引，currency不建立索引，因為選項較少，對於效能提升有限，且建立索引會降低寫入的效能。
4.Bnb資料相對變動頻率小，且只需要十筆，透過快取機制也許會比較快。



# AsiaYo API
This project is designed to check and transform the data.

## Installation
1. Clone the repository
2. Navigate into the project directory: `cd asiaYo`
3. Build the enviroment: `docker-compose up`
4. Setup the database: `php artisan migrate`
