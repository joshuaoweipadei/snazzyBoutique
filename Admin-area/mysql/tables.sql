CREATE DATABASE jewelry;

-- NEW TABLES
CREATE TABLE products (
	productId int(11) not null AUTO_INCREMENT PRIMARY KEY,
		productName varchar(255) not null,
    productCat int(11) not null,
    productBrand int(11) not null,
    productPrice int(11) not null,
    productDescription text(200) not null,
    productImage text(100) not null,
    productKeywords text(200) not null,
		date_inserted TIMESTAMP NOT NULL
);

-- cart TABLE
CREATE TABLE cart(
	id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    user_Id int(11) not null,
    ip_Address varchar(250) not null,
    pro_Id int(11) not null,
    pro_Name varchar(250) not null,
    pro_Image varchar(250) not null,
    Qty int(11) not null,
    pro_Price int(11) not null,
    total_Price int(11) not null
);


-- customers TABLE
CREATE TABLE customers (
	customerId int(11) not null AUTO_INCREMENT PRIMARY KEY,
    customerIP varchar(255) not null,
    c_FirstName varchar(200) not null,
    c_LastName varchar(200) not null,
    c_Email varchar(100) not null,
    c_Password varchar(100) not null,
    c_Hash varchar(100) not null,
    c_Country text(150) not null,
    c_City text(150) not null,
    c_Address text not null,
    c_Number varchar(255) not null,
    c_emailVerified tinyint(1) not null,
    c_Active tinyint(1) not null,
		Join_date timestamp not null
);


-- CUSTOMER IMAGES
CREATE TABLE customers_img(
	id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    customerId int(11) not null,
    c_Image varchar(255),
	c_Username varchar(255)
);


-- CATEGORY TABLE
CREATE TABLE categories (
	cat_Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    cat_Title text(100) not null,
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- BRAND TABLE
CREATE TABLE brands (
	brand_Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    brand_Title text(100) not null,
)ENGINE=InnoDB DEFAULT CHARSET=latin1;



-- COMMENT TABLE
CREATE TABLE comments (
	commentID int(11) not null AUTO_INCREMENT PRIMARY KEY,
    UserID int(11) not null,
    FullName varchar(100) not null,
    Comment varchar(100) not null,
    Date_posted timestamp not null,
    FOREIGN KEY (UserID) REFERENCES subscribers(UserID)
)ENGINE=InnoDB DEFAULT CHARSET=latin1;


-- ADMIN TABLE
CREATE TABLE admins(
	Admin_Id int(11) not null AUTO_INCREMENT PRIMARY KEY,
    Admin_Email varchar(255) not null,
    Admin_Password varchar(255) not null
);


-- AUCTION ITEMS TABLE
CREATE TABLE auction_items (
    auctionItemId int(11) not null AUTO_INCREMENT PRIMARY KEY,
    a_ItemName varchar(255) not null,
    a_ItemCat int(11) not null,
    a_ItemBrand int(11) not null,
    a_ItemImage text(100) not null,
    a_ItemDescription text not null,
		a_ItemKeywords text(300) not null,
    a_ItemOldPrice double not null,
		a_ItemMinBidPrice double not null,
    a_ItemDiscountRate varchar(50) not null,
    dateAuctionStarts datetime not null,
		dateAuctionEnds datetime not null
);




-- BIDDERS TABLE
CREATE TABLE bidders__customers (
	bidItemId int(11) not null AUTO_INCREMENT PRIMARY KEY,
    customerId int(11) not null,
    c_First varchar(100) not null,
    c_Last varchar(100) not null,
    c_Email varchar(100) not null,
    auctionBid_Id int(11) not null,
    auctionBid_Name varchar(150) not null,
    itemCat int(11) not null,
    itemBrand int(11) not null,
    min_Bid double not null,
    customer_Bid double not null,
    bidded_date datetime not null
);



-- reviews
CREATE TABLE reviews (
	review_id int(11) unsigned not null AUTO_INCREMENT,
    product_id mediumint(8) unsigned not null,
    product_type enum('page', 'pdf') not null,
    rating tinyint(1) unsigned not null,
    review mediumtext not null,
    reviewer_name varchar(100) not null,
    reviewer_email varchar(100) not null,
    review_date timestamp not null DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (review_id),
    KEY review_date (review_date),
    KEY product (product_id, product_type)
);

-- review ratings
CREATE TABLE review_ratings(
	review_rating_id int(11) unsigned not null AUTO_INCREMENT,
    review_id int(11) unsigned not null,
    helpful tinyint(1) unsigned not null,
    date_entered timestamp not null DEFAULT CURRENT_TIMESTAMP on UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (review_rating_id),
    key review_id (review_id),
    key date_entered (date_entered)
);
