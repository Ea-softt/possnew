DROP TABLE cashflow;

CREATE TABLE `cashflow` (
  `transaction_id` int(11) NOT NULL,
  `description` text,
  `amount` decimal(18,2) DEFAULT NULL,
  `username` varchar(30) DEFAULT NULL,
  `transaction_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`transaction_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;




DROP TABLE customer;

CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL,
  `firstnamec` varchar(40) DEFAULT NULL,
  `lastnamec` varchar(40) DEFAULT NULL,
  `address` text,
  `contact_number` varchar(50) DEFAULT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO customer VALUES("20","Peacew","Akorilw","P O BOX 14 Elubo Presbyw","054270794","1629874620_pass.jpeg");
INSERT INTO customer VALUES("24","emma","ackah","swwwwwww","0541019790","1635965820_1629874560_pass.jpeg");
INSERT INTO customer VALUES("25","Francis ","Cudjoe","box 6","","1642961280_7fd5ad91ac4cca0162890da285ecc444.jpg");
INSERT INTO customer VALUES("40","CATHERINE","NENRE","P. O BOX EL106, ELUBO- WESTERN REGION","02453583531","");
INSERT INTO customer VALUES("41","Samuel","Ackah","Box ","0541021978","");



DROP TABLE customersale;

CREATE TABLE `customersale` (
  `id` int(11) NOT NULL,
  `salername` varchar(255) NOT NULL,
  `customername` varchar(255) NOT NULL,
  `totalsale` int(255) NOT NULL,
  `discount` int(255) NOT NULL,
  `grandtotal` varchar(11) NOT NULL,
  `days` int(11) NOT NULL,
  `month` varchar(11) NOT NULL,
  `year` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO customersale VALUES("82","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("83","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("84","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("85","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("86","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("87","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("88","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("89","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("90","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("91","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("92","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("93","26","Emmanuel  Ackah","12","0","12","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("94","26","Emmanuel  Ackah","15","0","15","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("95","26","Emmanuel  Ackah","15","0","15","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("96","26","Emmanuel  Ackah","15","0","15","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("97","26","Emmanuel  Ackah","15","0","15","4","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("98","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("99","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("100","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("101","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("102","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("103","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("104","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("105","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("106","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("107","26","Emmanuel  Ackah","12","0","12","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("108","26","Emmanuel  Ackah","15","0","15","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("109","26","Emmanuel  Ackah","3","0","3","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("110","26","Emmanuel  Ackah","3","0","3","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("111","26","Emmanuel  Ackah","15","0","15","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("112","26","Emmanuel  Ackah","15","0","15","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("113","26","Emmanuel  Ackah","15","0","15","5","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("114","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("115","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("116","26","Emmanuel  Ackah","12","0","12","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("117","26","Emmanuel  Ackah","12","0","12","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("118","26","Emmanuel  Ackah","12","0","12","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("119","26","Emmanuel  Ackah","12","0","12","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("120","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("121","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("122","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("123","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("124","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("125","26","Emmanuel  Ackah","15","0","15","6","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("126","26","Emmanuel  Ackah","15","0","15","9","December","2021","2022-01-20 05:16:19");
INSERT INTO customersale VALUES("127","26","Emmanuel  Ackah","15","0","15","9","December","2021","2022-01-20 05:16:19");



DROP TABLE login;

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("1","1","c4ca4238a0b923820dcc509a6f75849b","a","Admin");
INSERT INTO login VALUES("16","1","c4ca4238a0b923820dcc509a6f75849b","a","Staff");
INSERT INTO login VALUES("17","2","c4ca4238a0b923820dcc509a6f75849b","a","Admin");



DROP TABLE moneyin;

CREATE TABLE `moneyin` (
  `id` int(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `day` int(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO moneyin VALUES("1","900","Daniel Akorli","2","January","2022");
INSERT INTO moneyin VALUES("2","344","Emmanuel Ackah","2","January","2022");
INSERT INTO moneyin VALUES("3","1000","Emmanuel Ackah","16","January","2022");
INSERT INTO moneyin VALUES("4","200","benedicta YAA AKORLI","24","February","2022");
INSERT INTO moneyin VALUES("5","5","benedicta YAA AKORLI","26","February","2022");



DROP TABLE moneyin_des;

CREATE TABLE `moneyin_des` (
  `did` int(11) NOT NULL,
  `money_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO moneyin_des VALUES("1","1","total sales for the day","900");
INSERT INTO moneyin_des VALUES("2","2","pay","344");
INSERT INTO moneyin_des VALUES("3","3","lodffd","1000");
INSERT INTO moneyin_des VALUES("4","4","bus","200");
INSERT INTO moneyin_des VALUES("5","5","food","5");



DROP TABLE moneyout;

CREATE TABLE `moneyout` (
  `id` int(255) NOT NULL,
  `total_amount` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `day` int(11) NOT NULL,
  `month` varchar(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO moneyout VALUES("1","200","Emmanuel Ackah","2","January","2022");
INSERT INTO moneyout VALUES("2","9000","Daniel Akorli","2","January","2022");
INSERT INTO moneyout VALUES("3","0","Emmanuel Ackah","16","January","2022");
INSERT INTO moneyout VALUES("4","0","ben","24","February","2022");
INSERT INTO moneyout VALUES("5","9","benedicta YAA AKORLI","24","February","2022");



DROP TABLE moneyout_des;

CREATE TABLE `moneyout_des` (
  `did` int(11) NOT NULL,
  `money_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO moneyout_des VALUES("1","1","Load","200");
INSERT INTO moneyout_des VALUES("2","2","looo","5000");
INSERT INTO moneyout_des VALUES("3","2","looo","40");
INSERT INTO moneyout_des VALUES("4","2","car","9000");
INSERT INTO moneyout_des VALUES("5","3","no money out","0");
INSERT INTO moneyout_des VALUES("6","4","no","0");
INSERT INTO moneyout_des VALUES("7","5","bus","9");



DROP TABLE newemployee;

CREATE TABLE `newemployee` (
  `EmpID` int(100) NOT NULL,
  `FullName` varchar(255) NOT NULL,
  `Gender` varchar(255) NOT NULL,
  `DOB` varchar(255) NOT NULL,
  `Age` int(255) NOT NULL,
  `Hometown` varchar(255) NOT NULL,
  `Nationality` varchar(255) NOT NULL,
  `Phonenum` varchar(20) NOT NULL,
  `Mail` varchar(255) NOT NULL,
  `Address` varchar(255) NOT NULL,
  `Address2` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Lastschool` varchar(255) NOT NULL,
  `Qualification` varchar(255) NOT NULL,
  `StartingDate` varchar(255) NOT NULL,
  `Employer` varchar(255) NOT NULL,
  `Language` varchar(255) NOT NULL,
  `Religion` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO newemployee VALUES("1","benedicta YAA AKORLI","Male","2005-02-02","24","bokorkrom","Ghanaian","0553896769","botee2020@gmail.com","	bokorkrom d/a basic school post office box 88 daboase	
		","	bokorkrom d/a basic school post office box 88 daboase	
		","Active","Active","benedicta YAA AKORLI","Degree","2022-01-15","","Nzema","Christian","1641072420_1633495740_Ea-Softlogo.png");
INSERT INTO newemployee VALUES("1","Matthew Kwofie","male","","90","Tikobo no 1","Ghanaian","0541021978","botee2020@gmail.com","		box 6 Elubo	
			
		","		box 5 Elubo	
			
		","Action","Sale","high senior school","Masters","","","Nzema","Christian","1640952720_1629873300_pass.jpeg");
INSERT INTO newemployee VALUES("2","benedicta YAA AKORLI","Male","2005-02-02","24","bokorkrom","Ghanaian","0553896769","botee2020@gmail.com","	bokorkrom d/a basic school post office box 88 daboase	
		","	bokorkrom d/a basic school post office box 88 daboase	
		","Active","Active","benedicta YAA AKORLI","Degree","2022-01-15","","Nzema","Christian","1641072420_1633495740_Ea-Softlogo.png");
INSERT INTO newemployee VALUES("3","CATHERINE AMAKYE NENRE","Male","2022-02-26","23","AHOBRE","ghana","0245358353","pajaxco@hotmail.com","				P. O BOX EL106, ELUBO- WESTERN REGION	
			
			
			
		","				P. O BOX EL106, ELUBO- WESTERN REGION	
			
			
			
		","Not active","Admin","CATHERINE AMAKYE NENRE","Some School Experienc","","","nzema","western","");



DROP TABLE note;

CREATE TABLE `note` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `notee` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO note VALUES("5","PRODUCT","24,442.00
25,369.00
927.00	32","2022-03-07 20:28:52");
INSERT INTO note VALUES("0","rwer","dsfdfsd","2022-03-13 07:37:46");



DROP TABLE prod;

CREATE TABLE `prod` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO prod VALUES("1","Emman");
INSERT INTO prod VALUES("2","the");
INSERT INTO prod VALUES("3","the");
INSERT INTO prod VALUES("4","the");
INSERT INTO prod VALUES("5","the");
INSERT INTO prod VALUES("6","the");
INSERT INTO prod VALUES("7","the");
INSERT INTO prod VALUES("8","the");
INSERT INTO prod VALUES("9","the");
INSERT INTO prod VALUES("10","the");
INSERT INTO prod VALUES("11","the");
INSERT INTO prod VALUES("12","the");
INSERT INTO prod VALUES("13","the");
INSERT INTO prod VALUES("14","the");
INSERT INTO prod VALUES("15","the");
INSERT INTO prod VALUES("16","the");
INSERT INTO prod VALUES("17","the");
INSERT INTO prod VALUES("18","");
INSERT INTO prod VALUES("19","");
INSERT INTO prod VALUES("20","");
INSERT INTO prod VALUES("21","");
INSERT INTO prod VALUES("22","");
INSERT INTO prod VALUES("23","");
INSERT INTO prod VALUES("24","");
INSERT INTO prod VALUES("25","");
INSERT INTO prod VALUES("26","");
INSERT INTO prod VALUES("27","");
INSERT INTO prod VALUES("28","");



DROP TABLE products;

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_no` varchar(11) NOT NULL,
  `product_name` varchar(11) DEFAULT NULL,
  `sell_price` decimal(18,2) DEFAULT NULL,
  `cprice` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit` varchar(30) DEFAULT NULL,
  `min_stocks` int(11) DEFAULT NULL,
  `expire_date` varchar(255) NOT NULL,
  `remarks` text,
  `location` varchar(255) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO products VALUES("10","17223","Microp","91.50","90","24","count","10","2022-01-28","brand new","","11");
INSERT INTO products VALUES("11","1241","Moto","5.50","4","153","count","15","2022-02-05","brand new","","12");
INSERT INTO products VALUES("12","14521","Microphone","91.50","90","67","count","16","2022-02-05","brand new","","14");
INSERT INTO products VALUES("13","18224","Milke","6.50","5","272","tin","10","2022-02-24","the ideal","","15");
INSERT INTO products VALUES("15","19285","ben","91.50","90","9","boxes","90","2022-02-25","wewewewew","","25");
INSERT INTO products VALUES("16","19266","ben","91.50","90","80","boxes","80","2022-02-25","wewewewew","","26");
INSERT INTO products VALUES("17","21187","tv","601.50","600","10","box","10","23-23-1222","4656678yuy","","28");



DROP TABLE salecustomeriterm;

CREATE TABLE `salecustomeriterm` (
  `barcode` int(11) NOT NULL,
  `product` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `qty` int(255) NOT NULL,
  `subtotal` int(255) NOT NULL,
  `salecustomerid` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","82");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","83");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","84");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","85");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","86");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","87");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","88");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","89");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","90");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","91");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","92");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","93");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","94");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","94");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","95");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","95");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","96");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","96");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","97");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","97");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","98");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","99");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","100");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","101");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","102");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","103");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","104");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","105");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","106");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","107");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","108");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","108");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","109");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","110");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","111");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","111");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","112");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","112");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","113");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","113");
INSERT INTO salecustomeriterm VALUES("0","Coffee","12.00","sachet","1","12","114");
INSERT INTO salecustomeriterm VALUES("0","milkye","3.00","rest","1","3","114");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","115");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","115");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","116");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","117");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","118");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","119");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","120");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","120");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","121");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","121");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","122");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","122");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","123");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","123");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","124");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","124");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","125");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","125");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","126");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","126");
INSERT INTO salecustomeriterm VALUES("1","Coffee","12.00","sachet","1","12","127");
INSERT INTO salecustomeriterm VALUES("2","milkye","3.00","rest","1","3","127");



DROP TABLE sales;

CREATE TABLE `sales` (
  `reciept_no` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `discount` int(11) NOT NULL,
  `total` int(30) NOT NULL,
  `grandtotal` int(33) NOT NULL,
  `days` int(11) NOT NULL,
  `month` varchar(11) NOT NULL,
  `years` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO sales VALUES("1","24","2","0","93","92","27","February","2022","2022-02-24 15:29:17");
INSERT INTO sales VALUES("2","24","2","0","103","103","27","February","2022","2022-02-24 15:38:00");
INSERT INTO sales VALUES("3","24","2","0","11","11","27","February","2022","2022-02-24 15:42:32");
INSERT INTO sales VALUES("4","20","2","0","12","12","28","February","2022","2022-02-25 05:48:47");
INSERT INTO sales VALUES("5","24","2","0","97","97","28","February","2022","2022-02-25 05:49:46");
INSERT INTO sales VALUES("6","24","2","8","84","92","28","February","2022","2022-02-25 10:55:59");
INSERT INTO sales VALUES("7","20","1","1","91","92","28","February","2022","2022-02-25 14:26:28");
INSERT INTO sales VALUES("8","26","2","0","411","411","29","February","2022","2022-02-26 08:25:59");
INSERT INTO sales VALUES("9","40","2","0","92","92","31","February","2022","2022-02-28 06:16:01");
INSERT INTO sales VALUES("10","20","2","0","13","13","3","March","2022","2022-03-03 17:43:22");
INSERT INTO sales VALUES("11","40","2","0","13","13","4","March","2022","2022-03-04 05:19:42");
INSERT INTO sales VALUES("12","24","2","0","275","275","4","March","2022","2022-03-04 13:33:01");
INSERT INTO sales VALUES("13","24","2","0","13","13","4","March","2022","2022-03-04 13:35:20");
INSERT INTO sales VALUES("14","20","2","0","92","92","4","March","2022","2022-03-04 13:46:38");
INSERT INTO sales VALUES("15","24","2","3","89","92","4","March","2022","2022-03-04 15:01:35");
INSERT INTO sales VALUES("16","24","2","0","602","602","4","March","2022","2022-03-04 15:48:19");
INSERT INTO sales VALUES("17","24","2","0","48120","48120","4","March","2022","2022-03-04 21:19:37");
INSERT INTO sales VALUES("18","41","2","0","275","275","8","March","2022","2022-03-08 06:33:37");



DROP TABLE sales_product;

CREATE TABLE `sales_product` (
  `reciept_no` int(11) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `price` decimal(18,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO sales_product VALUES("17","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("1","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("2","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("2","1241","5.50","2","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("3","1241","5.50","2","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("4","18224","6.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("4","1241","5.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("5","1241","5.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("5","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("6","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("7","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("8","17223","91.50","2","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("8","18224","6.50","21","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("8","19285","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("9","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("10","18224","6.50","2","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("11","18224","6.50","2","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("12","17223","91.50","3","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("13","18224","6.50","2","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("14","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("15","17223","91.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("16","21187","601.50","1","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("17","21187","601.50","80","2022-03-06 14:09:10");
INSERT INTO sales_product VALUES("18","17223","91.50","3","2022-03-08 06:33:37");



DROP TABLE supplier;

CREATE TABLE `supplier` (
  `supplier_id` int(11) NOT NULL,
  `companyname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `image` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO supplier VALUES("1","EA-Soft","CATHERINE","NENRE","P. O BOX EL106, ELUBO- WESTERN REGION 
                                    
                                 
                                    
                                ","024535556667","");



DROP TABLE suppliercompany;

CREATE TABLE `suppliercompany` (
  `id` int(11) NOT NULL,
  `companynameid` int(11) NOT NULL,
  `price2` int(11) NOT NULL,
  `multtota2` int(11) NOT NULL,
  `date_deliver` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO suppliercompany VALUES("6","0","10","40","2022-01-16 18:31:51");
INSERT INTO suppliercompany VALUES("7","0","275","1305","2022-01-21 06:20:41");
INSERT INTO suppliercompany VALUES("8","0","4","12","2022-01-23 10:41:57");
INSERT INTO suppliercompany VALUES("9","0","4","12","2022-01-23 10:42:27");
INSERT INTO suppliercompany VALUES("10","0","2","6","2022-01-23 10:50:29");
INSERT INTO suppliercompany VALUES("11","0","2","6","2022-01-23 10:54:49");
INSERT INTO suppliercompany VALUES("12","0","2","6","2022-01-23 10:54:58");
INSERT INTO suppliercompany VALUES("14","0","4","16","2022-01-23 11:08:38");
INSERT INTO suppliercompany VALUES("15","0","4","16","2022-01-23 11:09:38");
INSERT INTO suppliercompany VALUES("16","0","4","16","2022-01-23 11:09:39");
INSERT INTO suppliercompany VALUES("17","0","4","16","2022-01-23 11:09:46");
INSERT INTO suppliercompany VALUES("24","0","4","12","2022-01-23 11:21:18");
INSERT INTO suppliercompany VALUES("25","0","3","69","2022-01-23 11:23:16");
INSERT INTO suppliercompany VALUES("28","0","3","6","2022-01-23 11:29:57");
INSERT INTO suppliercompany VALUES("29","0","3","9","2022-01-23 11:36:25");
INSERT INTO suppliercompany VALUES("30","0","3","9","2022-01-23 11:44:18");
INSERT INTO suppliercompany VALUES("31","0","3","9","2022-01-23 11:44:19");
INSERT INTO suppliercompany VALUES("32","0","3","9","2022-01-23 11:47:01");
INSERT INTO suppliercompany VALUES("33","0","3","9","2022-01-23 11:47:08");
INSERT INTO suppliercompany VALUES("34","0","3","9","2022-01-23 11:47:09");
INSERT INTO suppliercompany VALUES("35","0","3","9","2022-01-23 11:47:09");
INSERT INTO suppliercompany VALUES("36","0","3","9","2022-01-23 11:47:09");
INSERT INTO suppliercompany VALUES("37","0","3","9","2022-01-23 11:47:10");
INSERT INTO suppliercompany VALUES("38","0","3","9","2022-01-23 11:47:10");
INSERT INTO suppliercompany VALUES("39","0","3","9","2022-01-23 11:47:10");
INSERT INTO suppliercompany VALUES("40","0","2","64","2022-01-23 11:55:21");
INSERT INTO suppliercompany VALUES("41","0","2","64","2022-01-23 12:00:21");
INSERT INTO suppliercompany VALUES("42","0","2","64","2022-01-23 12:00:22");
INSERT INTO suppliercompany VALUES("43","0","2","64","2022-01-23 12:01:40");
INSERT INTO suppliercompany VALUES("46","0","3","129","2022-01-23 12:15:49");
INSERT INTO suppliercompany VALUES("48","0","2","6","2022-01-23 12:29:14");
INSERT INTO suppliercompany VALUES("52","0","3","9","2022-01-23 12:40:28");
INSERT INTO suppliercompany VALUES("53","0","2","46","2022-01-23 12:41:36");
INSERT INTO suppliercompany VALUES("54","0","2","6","2022-01-23 12:44:12");
INSERT INTO suppliercompany VALUES("55","0","3","6","2022-01-23 12:46:26");
INSERT INTO suppliercompany VALUES("56","0","9","45","2022-01-23 12:52:29");
INSERT INTO suppliercompany VALUES("58","0","5","20","2022-01-23 12:56:58");
INSERT INTO suppliercompany VALUES("59","0","408","2048","2022-01-23 14:21:10");
INSERT INTO suppliercompany VALUES("60","0","90","720","2022-01-23 14:23:59");
INSERT INTO suppliercompany VALUES("61","0","90","360","2022-01-23 14:32:48");
INSERT INTO suppliercompany VALUES("62","0","5","45","2022-02-24 16:05:22");
INSERT INTO suppliercompany VALUES("63","0","90","20970","2022-02-25 10:50:15");
INSERT INTO suppliercompany VALUES("64","1","7","140","2022-02-26 16:51:46");
INSERT INTO suppliercompany VALUES("65","1","605","6020","2022-03-04 15:11:04");



DROP TABLE supplierdeliver;

CREATE TABLE `supplierdeliver` (
  `sid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `multtota` int(255) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO supplierdeliver VALUES("6","Milke","10","5","45","tin","the ideal","62","2022-02-24 16:05:22");
INSERT INTO supplierdeliver VALUES("7","ben","233","90","20970","boxes","wewewewew","63","2022-02-25 10:50:15");
INSERT INTO supplierdeliver VALUES("8","ben","20","7","140","box","","64","2022-02-26 16:51:46");
INSERT INTO supplierdeliver VALUES("9","tv","10","600","6000","box","4656678yuy","65","2022-03-04 15:11:04");
INSERT INTO supplierdeliver VALUES("10","rrer","4","5","20","boxes","esrty","65","2022-03-04 15:11:04");



DROP TABLE users;

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `position` varchar(20) NOT NULL,
  `contact_number` varchar(30) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("26","Emmanuel ","Ackah","Manager","0541021978","");



DROP TABLE warehouse;

CREATE TABLE `warehouse` (
  `sid` int(11) NOT NULL,
  `supplierid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `multtota` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `expire_date` varchar(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO warehouse VALUES("1","3","Moto","0","4","24","count","brand new","","1642968960_92164a2ad77580703ef43d42329521b4.jpg","2022-01-23 14:21:10");
INSERT INTO warehouse VALUES("14","60","Microphone","0","90","720","count","brand new","2022-02-05","1642968960_9b96b60092b1d216625320a0599d48b9.jpg","2022-01-23 14:23:59");
INSERT INTO warehouse VALUES("17","60","Microp","0","90","720","count","brand new","2022-01-28","1642968480_14b9fd9c029c311174b2f4639a259fff.jpg","2022-01-23 20:08:57");
INSERT INTO warehouse VALUES("18","62","Milke","-1","5","45","tin","the ideal","2022-02-24","","2022-02-24 16:05:22");
INSERT INTO warehouse VALUES("19","63","ben","0","90","20970","boxes","wewewewew","2022-02-25","","2022-02-25 10:50:15");
INSERT INTO warehouse VALUES("20","64","ben","0","7","140","box","","","","2022-02-26 16:51:46");
INSERT INTO warehouse VALUES("21","65","tv","-10","600","6000","box","4656678yuy","","","2022-03-04 15:11:04");
INSERT INTO warehouse VALUES("22","65","rrer","4","5","20","boxes","esrty","","","2022-03-04 15:11:04");



