

CREATE TABLE subscribers (
	UserID int(11) not null AUTO_INCREMENT PRIMARY KEY,
    Firstname varchar(50) not null,
    Lastname varchar(50) not null,
    Email varchar(200) not null,
    Country varchar(50) not null,
    `Password` varchar(100) not null,
    `Hash` varchar(50) not null,
    emailVerified tinyint(1) not null,
    Active tinyint(1) not null
);

-- PRODUCT IN STOCK
CREATE TABLE products (
	productID int(11) not null AUTO_INCREMENT PRIMARY KEY,
    title varchar(255) not null,
    image varchar(255) not null,
    description text not null,
    price varchar(255) not null,
    date_added date not null
)ENGINE=InnoDB DEFAULT CHARSET=latin1;
