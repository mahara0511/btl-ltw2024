-- Active: 1727756928890@@127.0.0.1@3306@onlineshop
-- CREATE DATABASE onlineshop DEFAULT CHARACTER SET = 'utf8mb4';

-- Table structure for table `brands`
CREATE TABLE `brands` (
    `brand_id` INT(100) NOT NULL,
    `brand_title` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `categories`
CREATE TABLE `categories` (
    `cat_id` INT(100) NOT NULL,
    `cat_title` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `products`
CREATE TABLE `products` (
    `product_id` INT(100) NOT NULL,
    `product_cat` INT(100) NOT NULL,
    `product_brand` INT(100) NOT NULL,
    `product_title` VARCHAR(255) NOT NULL,
    `product_price` DECIMAL(10, 2) NOT NULL,
    `product_sale` INT(4) NOT NULL,
    `product_desc` TEXT NOT NULL,
    `product_image` TEXT NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `user_info`
CREATE TABLE `user_info` (
    `user_id` INT(10) NOT NULL,
    `first_name` VARCHAR(100) NOT NULL,
    `last_name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `mobile` VARCHAR(15) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `district` VARCHAR(255) NOT NULL,
    `province` VARCHAR(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `cart`
CREATE TABLE `cart` (
    `id` INT(10) NOT NULL,
    `p_id` INT(100) NOT NULL,
    `user_id` INT(10) NOT NULL,
    `qty` INT(10) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `orders_info`
CREATE TABLE `orders_info` (
    `order_id` INT(10) NOT NULL,
    `user_id` INT(11) NOT NULL,
    `order_date` DATE NOT NULL,
    `f_name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `address` VARCHAR(255) NOT NULL,
    `city` VARCHAR(255) NOT NULL,
    `state` VARCHAR(255) NOT NULL,
    `cardname` VARCHAR(255) NOT NULL,
    `cardnumber` VARCHAR(20) NOT NULL,
    `prod_count` INT(15) DEFAULT NULL,
    `total_amt` DECIMAL(10, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `order_products`
CREATE TABLE `order_products` (
    `order_pro_id` INT(10) NOT NULL,
    `order_id` INT(11) NOT NULL,
    `product_id` INT(11) NOT NULL,
    `qty` INT(15) DEFAULT NULL,
    `amt` DECIMAL(10, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `comments`
CREATE TABLE `comments` (
    `cmt_id` INT(10) UNSIGNED NOT NULL,
    `user_id` INT(10) NOT NULL,
    `p_id` INT(10) NOT NULL,
    `parent_id` INT(10) UNSIGNED DEFAULT NULL,
    `cmt_date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `content` TEXT NOT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

-- Table structure for table `newscategory`
CREATE TABLE `newscategory` (
    `id` int(11) NOT NULL,
    `name` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Table structure for table `news`
CREATE TABLE `news` (
    `id` int(11) NOT NULL,
    `title` varchar(255) DEFAULT NULL,
    `subtitle` varchar(255) DEFAULT NULL,
    `content` varchar(8191) DEFAULT NULL,
    `img` varchar(255) DEFAULT NULL,
    `categoryid` int(11) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- Table structure for table `admin_info`
CREATE TABLE `admin_info` (
    `admin_id` int(10) NOT NULL,
    `admin_name` varchar(100) NOT NULL,
    `admin_email` varchar(255) NOT NULL,
    `admin_password` varchar(255) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
    `admin_info` (
        `admin_id`,
        `admin_name`,
        `admin_email`,
        `admin_password`
    )
VALUES (
        1,
        'admin',
        'admin@gmail.com',
        MD5('admin123')
    ),
    (
        2,
        'admin2',
        'admin2@gmail.com',
        MD5('admin123')
    );

-- Table structure for table `email_info`
CREATE TABLE `email_info` (
    `email_id` int(100) NOT NULL,
    `email` text NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = latin1;

INSERT INTO
    `email_info` (`email_id`, `email`)
VALUES (3, 'admin@gmail.com'),
    (
        4,
        'puneethreddy951@gmail.com'
    ),
    (5, 'puneethreddy@gmail.com');

-- Add PRIMARY KEYS
ALTER TABLE `brands` ADD PRIMARY KEY (`brand_id`);

ALTER TABLE `categories` ADD PRIMARY KEY (`cat_id`);

ALTER TABLE `products` ADD PRIMARY KEY (`product_id`);

ALTER TABLE `user_info` ADD PRIMARY KEY (`user_id`);

ALTER TABLE `cart` ADD PRIMARY KEY (`id`);

ALTER TABLE `orders_info` ADD PRIMARY KEY (`order_id`);

ALTER TABLE `order_products` ADD PRIMARY KEY (`order_pro_id`);

ALTER TABLE `comments` ADD PRIMARY KEY (`cmt_id`);

ALTER TABLE `newscategory` ADD PRIMARY KEY (`id`);

ALTER TABLE `news`
ADD PRIMARY KEY (`id`),
ADD KEY `categoryid` (`categoryid`);

-- Add AUTO_INCREMENT
ALTER TABLE `brands`
MODIFY `brand_id` INT(100) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `categories`
MODIFY `cat_id` INT(100) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `products`
MODIFY `product_id` INT(100) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `user_info`
MODIFY `user_id` INT(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `cart`
MODIFY `id` INT(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `orders_info`
MODIFY `order_id` INT(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `order_products`
MODIFY `order_pro_id` INT(10) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `comments`
MODIFY `cmt_id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `newscategory`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

ALTER TABLE `news`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
AUTO_INCREMENT = 1;

-- Add FOREIGN KEYS
ALTER TABLE `cart`
ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`p_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

ALTER TABLE `cart`
ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `orders_info`
ADD CONSTRAINT `fk_orders_info_user` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE;

ALTER TABLE `order_products`
ADD CONSTRAINT `fk_order_products_order` FOREIGN KEY (`order_id`) REFERENCES `orders_info` (`order_id`) ON DELETE CASCADE;

ALTER TABLE `order_products`
ADD CONSTRAINT `fk_order_products_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

ALTER TABLE `comments`
ADD CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_id`) REFERENCES `user_info` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `comments`
ADD CONSTRAINT `fk_comments_product` FOREIGN KEY (`p_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `comments`
ADD CONSTRAINT `fk_comments_parent` FOREIGN KEY (`parent_id`) REFERENCES `comments` (`cmt_id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `news`
ADD CONSTRAINT `news_ibfk_1` FOREIGN KEY (`categoryid`) REFERENCES `newscategory` (`id`);

-- INSERT DATA ------------------------------------------------------------------
INSERT INTO
    `brands` (`brand_id`, `brand_title`)
VALUES (1, 'HP'),
    (2, 'Samsung'),
    (3, 'Apple'),
    (4, 'motorolla'),
    (5, 'LG'),
    (6, 'Cloth Brand');

INSERT INTO
    `categories` (`cat_id`, `cat_title`)
VALUES (1, 'Electronics'),
    (2, 'Ladies Wears'),
    (3, 'Mens Wear'),
    (4, 'Kids Wear'),
    (5, 'Furnitures'),
    (6, 'Home Appliances'),
    (7, 'Electronics Gadgets');

INSERT INTO
    `products` (
        `product_id`,
        `product_cat`,
        `product_brand`,
        `product_title`,
        `product_price`,
        `product_sale`,
        `product_desc`,
        `product_image`
    )
VALUES (
        1,
        1,
        2,
        'Samsung Galaxy S7 Edge',
        5000,
        20,
        'The Samsung Galaxy S7 Edge offers cutting-edge technology with a sleek design, ideal for mobile and multimedia usage.',
        'product07.png'
    ),
    (
        2,
        1,
        3,
        'iPhone 5s',
        25000,
        15,
        'Apple iPhone 5s combines elegance and performance, perfect for mobile enthusiasts.',
        'http___pluspng.com_img-png_iphone-hd-png-iphone-apple-png-file-550.png'
    ),
    (
        3,
        1,
        3,
        'iPad Air 2',
        30000,
        10,
        'Apple iPad Air 2 delivers a seamless tablet experience for productivity and entertainment.',
        'da4371ffa192a115f922b1c0dff88193.png'
    ),
    (
        4,
        1,
        3,
        'iPhone 6s',
        32000,
        25,
        'The Apple iPhone 6s offers advanced features in a premium design.',
        'http___pluspng.com_img-png_iphone-6s-png-iphone-6s-gold-64gb-1000.png'
    ),
    (
        5,
        1,
        2,
        'iPad 2',
        10000,
        30,
        'The Samsung iPad 2 is a versatile device for work and play.',
        'iPad-air.png'
    ),
    (
        6,
        1,
        1,
        'Samsung Laptop R Series',
        35000,
        5,
        'The Samsung Laptop R Series delivers powerful computing for professionals.',
        'laptop_PNG5939.png'
    ),
    (
        7,
        1,
        1,
        'HP Pavilion Laptop',
        50000,
        18,
        'HP Pavilion Laptop combines performance with style, perfect for work and entertainment.',
        'laptop_PNG5930.png'
    ),
    (
        8,
        1,
        4,
        'Sony Xperia Z',
        40000,
        10,
        'Sony Xperia Z combines stunning visuals with high performance in a sleek design.',
        '530201353846AM_635_sony_xperia_z.png'
    ),
    (
        9,
        1,
        3,
        'iPhone New',
        12000,
        20,
        'Apple iPhone New model offers fresh features and enhanced user experience.',
        'iphone-hd-png-iphone-apple-png-file-550.png'
    ),
    (
        10,
        2,
        6,
        'Red Ladies Dress',
        1000,
        25,
        'Elegant red dress for ladies, perfect for casual and formal occasions.',
        'red dress.jpg'
    ),
    (
        11,
        2,
        6,
        'Blue Heave Dress',
        1200,
        15,
        'Stylish blue dress, ideal for every wardrobe.',
        'images.jpg'
    ),
    (
        12,
        2,
        6,
        'Ladies Casual Clothes',
        1500,
        12,
        'Comfortable and chic casual wear for ladies.',
        '7475-ladies-casual-dresses-summer-two-colors-pleated.jpg'
    ),
    (
        13,
        2,
        6,
        'Spring Autumn Dress',
        1200,
        30,
        'Seasonal dress perfect for spring and autumn wear.',
        'Spring-Autumn-Winter-Young-Ladies-Casual-Wool-Dress-Women-s-One-Piece-Dresse-Dating-Clothes-Medium.jpg_640x640.jpg'
    ),
    (
        14,
        2,
        6,
        'Casual Dress',
        1400,
        20,
        'Relaxed yet stylish casual dress for women.',
        'download.jpg'
    ),
    (
        15,
        2,
        6,
        'Formal Look',
        1500,
        10,
        'Professional and polished formal wear for ladies.',
        'shutterstock_203611819.jpg'
    ),
    (
        16,
        3,
        6,
        'Sweater for Men',
        600,
        20,
        'Warm and comfortable sweater for men, perfect for winter.',
        '2012-Winter-Sweater-for-Men-for-better-outlook.jpg'
    ),
    (
        17,
        3,
        6,
        'Gents Formal',
        1000,
        10,
        'Sharp and sophisticated formal wear for men.',
        'gents-formal-250x250.jpg'
    ),
    (
        19,
        3,
        6,
        'Formal Coat',
        3000,
        15,
        'Premium formal coat designed for elegance and warmth.',
        'images (1).jpg'
    ),
    (
        20,
        3,
        6,
        'Men\'s Sweater',
        1600,
        25,
        'Stylish and cozy sweater for men.',
        'Winter-fashion-men-burst-sweater.png'
    ),
    (
        21,
        3,
        6,
        'T-Shirt',
        800,
        20,
        'Casual and comfortable T-shirt for daily wear.',
        'IN-Mens-Apparel-Voodoo-Tiles-09._V333872612_.jpg'
    ),
    (
        22,
        4,
        6,
        'Yellow T-Shirt',
        1300,
        15,
        'Bright yellow T-shirt for kids, perfect for casual outings.',
        '1.0x0.jpg'
    ),
    (
        23,
        4,
        6,
        'Girls Clothes',
        1900,
        10,
        'Fashionable and comfortable clothing for girls.',
        'GirlsClothing_Widgets.jpg'
    ),
    (
        24,
        4,
        6,
        'Blue T-Shirt',
        700,
        12,
        'Stylish blue T-shirt for kids.',
        'images.jpg'
    ),
    (
        25,
        4,
        6,
        'Yellow Girls Dress',
        750,
        20,
        'Adorable yellow dress for young girls.',
        'images (3).jpg'
    ),
    (
        32,
        5,
        0,
        'Book Shelf',
        2500,
        15,
        'Durable and spacious book shelf, perfect for organizing books.',
        'furniture-book-shelf-250x250.jpg'
    ),
    (
        33,
        6,
        2,
        'Refrigerator',
        35000,
        10,
        'High-performance Samsung refrigerator for modern kitchens.',
        'CT_WM_BTS-BTC-AppliancesHome_20150723.jpg'
    ),
    (
        34,
        6,
        4,
        'Emergency Light',
        1000,
        12,
        'Reliable and portable emergency light.',
        'emergency light.JPG'
    ),
    (
        35,
        6,
        0,
        'Vacuum Cleaner',
        6000,
        15,
        'Powerful and efficient vacuum cleaner for spotless homes.',
        'images (2).jpg'
    ),
    (
        36,
        6,
        5,
        'Iron',
        1500,
        20,
        'Compact and efficient iron for smooth clothing.',
        'iron.JPG'
    ),
    (
        37,
        6,
        5,
        'LED TV',
        20000,
        30,
        'Crystal-clear LED TV for an immersive viewing experience.',
        'images (4).jpg'
    ),
    (
        38,
        6,
        4,
        'Microwave Oven',
        3500,
        10,
        'Convenient and versatile microwave oven for easy cooking.',
        'images.jpg'
    ),
    (
        39,
        6,
        5,
        'Mixer Grinder',
        2500,
        12,
        'Efficient mixer grinder for versatile kitchen tasks.',
        'singer-mixer-grinder-mg-46-medium_4bfa018096c25dec7ba0af40662856ef.jpg'
    ),
    (
        40,
        2,
        6,
        'Formal girls dress',
        3000,
        10,
        'Elegant formal dress for girls',
        'girl-walking.jpg'
    ),
    (
        45,
        1,
        2,
        'Samsung Galaxy Note 3',
        10000,
        0,
        'Samsung Galaxy Note 3 Neo smartphone',
        'samsung_galaxy_note3_note3neo.JPG'
    ),
    (
        46,
        1,
        2,
        'Samsung Galaxy Note 3',
        10000,
        5,
        'Samsung Galaxy Note 3 Neo smartphone',
        'samsung_galaxy_note3_note3neo.JPG'
    ),
    (
        47,
        4,
        6,
        'Dell Laptop',
        650,
        15,
        'High-performance Dell laptop',
        'product01.png'
    ),
    (
        48,
        1,
        7,
        'Headphones',
        250,
        0,
        'Sony over-ear headphones',
        'product05.png'
    ),
    (
        49,
        1,
        7,
        'Headphones',
        250,
        5,
        'Sony over-ear headphones',
        'product05.png'
    ),
    (
        50,
        3,
        6,
        'Boys shirts',
        350,
        20,
        'Stylish boys\' shirts',
        'pm1.JPG'
    ),
    (
        51,
        3,
        6,
        'Boys shirts',
        270,
        15,
        'Stylish boys\' shirts',
        'pm2.JPG'
    ),
    (
        52,
        3,
        6,
        'Boys shirts',
        453,
        10,
        'Stylish boys\' shirts',
        'pm3.JPG'
    ),
    (
        53,
        3,
        6,
        'Boys shirts',
        220,
        5,
        'Stylish boys\' shirts',
        'ms1.JPG'
    ),
    (
        54,
        3,
        6,
        'Boys shirts',
        290,
        25,
        'Stylish boys\' shirts',
        'ms2.JPG'
    ),
    (
        55,
        3,
        6,
        'Boys shirts',
        259,
        10,
        'Stylish boys\' shirts',
        'ms3.JPG'
    ),
    (
        56,
        3,
        6,
        'Boys shirts',
        299,
        0,
        'Stylish boys\' shirts',
        'pm7.JPG'
    ),
    (
        57,
        3,
        6,
        'Boys shirts',
        260,
        5,
        'Stylish boys\' shirts',
        'i3.JPG'
    ),
    (
        58,
        3,
        6,
        'Boys shirts',
        350,
        15,
        'Stylish boys\' shirts',
        'pm9.JPG'
    ),
    (
        59,
        3,
        6,
        'Boys shirts',
        855,
        20,
        'Stylish boys\' shirts',
        'a2.JPG'
    ),
    (
        60,
        3,
        6,
        'Boys shirts',
        150,
        5,
        'Stylish boys\' shirts',
        'pm11.JPG'
    ),
    (
        61,
        3,
        6,
        'Boys shirts',
        215,
        0,
        'Stylish boys\' shirts',
        'pm12.JPG'
    ),
    (
        62,
        3,
        6,
        'Boys shirts',
        299,
        10,
        'Stylish boys\' shirts',
        'pm13.JPG'
    ),
    (
        63,
        3,
        6,
        'Boys Jeans Pant',
        550,
        20,
        'Durable boys\' jeans',
        'pt1.JPG'
    ),
    (
        64,
        3,
        6,
        'Boys Jeans Pant',
        460,
        10,
        'Durable boys\' jeans',
        'pt2.JPG'
    ),
    (
        65,
        3,
        6,
        'Boys Jeans Pant',
        470,
        5,
        'Durable boys\' jeans',
        'pt3.JPG'
    ),
    (
        66,
        3,
        6,
        'Boys Jeans Pant',
        480,
        15,
        'Durable boys\' jeans',
        'pt4.JPG'
    ),
    (
        67,
        3,
        6,
        'Boys Jeans Pant',
        360,
        10,
        'Durable boys\' jeans',
        'pt5.JPG'
    ),
    (
        68,
        3,
        6,
        'Boys Jeans Pant',
        550,
        5,
        'Durable boys\' jeans',
        'pt6.JPG'
    ),
    (
        69,
        3,
        6,
        'Boys Jeans Pant',
        390,
        0,
        'Durable boys\' jeans',
        'pt7.JPG'
    ),
    (
        70,
        3,
        6,
        'Boys Jeans Pant',
        399,
        25,
        'Durable boys\' jeans',
        'pt8.JPG'
    ),
    (
        71,
        1,
        2,
        'Samsung Galaxy S7',
        5000,
        10,
        'Samsung Galaxy S7 smartphone',
        'product07.png'
    ),
    (
        72,
        7,
        2,
        'Sony Headphones',
        3500,
        0,
        'Sony headphones with noise cancellation',
        'product02.png'
    ),
    (
        73,
        7,
        2,
        'Samsung Headphones',
        3500,
        5,
        'Samsung headphones with clear audio',
        'product05.png'
    ),
    (
        74,
        1,
        1,
        'HP i5 Laptop',
        5500,
        15,
        'HP laptop with i5 processor',
        'product01.png'
    ),
    (
        75,
        1,
        1,
        'HP i7 Laptop 8GB RAM',
        5500,
        10,
        'HP laptop with i7 processor and 8GB RAM',
        'product03.png'
    ),
    (
        76,
        1,
        5,
        'Sony Note 6GB RAM',
        4500,
        20,
        'Sony Note smartphone with 6GB RAM',
        'product04.png'
    ),
    (
        77,
        1,
        4,
        'MSV Laptop 16GB RAM',
        5499,
        5,
        'MSV laptop with NVIDIA graphics and 16GB RAM',
        'product06.png'
    ),
    (
        78,
        1,
        5,
        'Dell Laptop 8GB RAM',
        4579,
        10,
        'Dell laptop with integrated graphics',
        'product08.png'
    ),
    (
        79,
        7,
        2,
        '3D Pixel Camera',
        2569,
        0,
        'Camera with 3D pixel technology',
        'product09.png'
    ),
    (
        80,
        1,
        1,
        'Ytrfdkjsd',
        12343,
        50,
        'Miscellaneous product',
        '1542455446_thythtf.jpeg'
    ),
    (
        81,
        4,
        6,
        'Kids Blue Dress',
        300,
        15,
        'Beautiful kids\' blue dress',
        '1543993724_pg4.jpg'
    );

INSERT INTO
    `user_info` (
        `first_name`,
        `last_name`,
        `email`,
        `password`,
        `mobile`,
        `address`,
        `district`,
        `province`
    )
VALUES (
        'John',
        'Doe',
        'john.doe@example.com',
        MD5('password123'),
        '9876543210',
        '123 Main Street',
        'New York',
        'NY'
    ),
    (
        'Jane',
        'Smith',
        'jane.smith@example.com',
        MD5('password123'),
        '9876543211',
        '456 Oak Avenue',
        'Los Angeles',
        'CA'
    ),
    (
        'Alice',
        'Johnson',
        'alice.johnson@example.com',
        MD5('password123'),
        '9876543212',
        '789 Pine Road',
        'San Francisco',
        'CA'
    ),
    (
        'Bob',
        'Brown',
        'bob.brown@example.com',
        MD5('password123'),
        '9876543213',
        '101 Maple Lane',
        'Chicago',
        'IL'
    ),
    (
        'Charlie',
        'Williams',
        'charlie.williams@example.com',
        MD5('password123'),
        '9876543214',
        '202 Birch Street',
        'Houston',
        'TX'
    ),
    (
        'David',
        'Jones',
        'david.jones@example.com',
        MD5('password123'),
        '9876543215',
        '303 Cedar Drive',
        'Phoenix',
        'AZ'
    ),
    (
        'Eva',
        'Miller',
        'eva.miller@example.com',
        MD5('password123'),
        '9876543216',
        '404 Elm Boulevard',
        'Philadelphia',
        'PA'
    ),
    (
        'Frank',
        'Davis',
        'frank.davis@example.com',
        MD5('password123'),
        '9876543217',
        '505 Pine Circle',
        'San Antonio',
        'TX'
    ),
    (
        'Grace',
        'Garcia',
        'grace.garcia@example.com',
        MD5('password123'),
        '9876543218',
        '606 Oak Avenue',
        'San Diego',
        'CA'
    ),
    (
        'Henry',
        'Martinez',
        'henry.martinez@example.com',
        MD5('password123'),
        '9876543219',
        '707 Maple Street',
        'Dallas',
        'TX'
    ),
    (
        'Isabel',
        'Hernandez',
        'isabel.hernandez@example.com',
        MD5('password123'),
        '9876543220',
        '808 Birch Lane',
        'Austin',
        'TX'
    ),
    (
        'Jack',
        'Lopez',
        'jack.lopez@example.com',
        MD5('password123'),
        '9876543221',
        '909 Cedar Street',
        'Jacksonville',
        'FL'
    ),
    (
        'Karen',
        'Gonzalez',
        'karen.gonzalez@example.com',
        MD5('password123'),
        '9876543222',
        '1001 Elm Avenue',
        'Fort Worth',
        'TX'
    ),
    (
        'Louis',
        'Wilson',
        'louis.wilson@example.com',
        MD5('password123'),
        '9876543223',
        '1102 Pine Road',
        'Columbus',
        'OH'
    ),
    (
        'Maria',
        'Taylor',
        'maria.taylor@example.com',
        MD5('password123'),
        '9876543224',
        '1203 Oak Boulevard',
        'Charlotte',
        'NC'
    ),
    (
        'Nina',
        'Anderson',
        'nina.anderson@example.com',
        MD5('password123'),
        '9876543225',
        '1304 Maple Drive',
        'Detroit',
        'MI'
    ),
    (
        'Oscar',
        'Thomas',
        'oscar.thomas@example.com',
        MD5('password123'),
        '9876543226',
        '1405 Birch Circle',
        'Boston',
        'MA'
    ),
    (
        'Paul',
        'Jackson',
        'paul.jackson@example.com',
        MD5('password123'),
        '9876543227',
        '1506 Cedar Lane',
        'Seattle',
        'WA'
    ),
    (
        'Quincy',
        'White',
        'quincy.white@example.com',
        MD5('password123'),
        '9876543228',
        '1607 Elm Road',
        'Denver',
        'CO'
    ),
    (
        'Rita',
        'Harris',
        'rita.harris@example.com',
        MD5('password123'),
        '9876543229',
        '1708 Pine Boulevard',
        'Portland',
        'OR'
    );

INSERT INTO
    `cart` (`p_id`, `user_id`, `qty`)
VALUES (1, 1, 2),
    (2, 1, 1),
    (3, 2, 3),
    (4, 2, 1),
    (5, 3, 2),
    (6, 3, 1),
    (7, 4, 5),
    (8, 4, 2),
    (9, 5, 1),
    (10, 5, 4),
    (11, 6, 3),
    (12, 6, 2),
    (13, 7, 1),
    (14, 7, 6),
    (15, 8, 2),
    (16, 8, 3),
    (17, 9, 1),
    (20, 9, 5),
    (19, 10, 4),
    (20, 10, 2);

-- Insert comments (original comments for different products)
INSERT INTO
    `comments` (
        user_id,
        p_id,
        content,
        parent_id,
        cmt_date,
        created_at
    )
VALUES (
        1,
        1,
        'Great product! I really liked it.',
        NULL,
        NOW(),
        NOW()
    ),
    (
        2,
        2,
        'Not bad, but could be improved.',
        NULL,
        NOW(),
        NOW()
    ),
    (
        3,
        3,
        'Terrible, would not recommend!',
        NULL,
        NOW(),
        NOW()
    ),
    (
        1,
        4,
        'Amazing quality, will buy again.',
        NULL,
        NOW(),
        NOW()
    ),
    (
        4,
        5,
        'Good, but too expensive.',
        NULL,
        NOW(),
        NOW()
    );

-- Dumping data for table `newscategory`
INSERT INTO
    `newscategory` (`id`, `name`)
VALUES (1, 'Product Updates'),
    (2, 'Promotions & Discounts'),
    (3, 'About Our Company'),
    (4, 'Customer Spotlights');

INSERT INTO
    `news` (
        `id`,
        `title`,
        `subtitle`,
        `content`,
        `img`,
        `categoryid`
    )
VALUES (
        1,
        'New Arrivals Alert: Explore Our Latest Collection of Fall Essentials!',
        'Discover the freshest looks for the season with our exclusive fall collection. Shop now to stay stylish!',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis tortor id tempor hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent finibus diam erat, eget ultrices ante congue a. Proin sed tellus aliquet, laoreet sapien eu, sagittis lorem. Proin varius, mauris bibendum accumsan maximus, lacus diam pulvinar libero, quis aliquet lacus massa quis metus. Sed vitae mi vitae dolor eleifend consequat et at nisi. Maecenas eleifend arcu ac fringilla accumsan. Curabitur placerat leo ac mollis ultricies. Etiam lectus sem, iaculis imperdiet cursus ut, ornare mollis mauris. Suspendisse potenti. Sed id euismod purus, vitae euismod arcu. Nulla purus dolor, consequat sit amet libero sed, venenatis dapibus justo. Mauris placerat leo in consequat facilisis. Ut vestibulum eros at sem fringilla pharetra. Donec in rutrum sapien, sit amet tincidunt metus.\r\n\r\nAliquam non placerat dolor. Nullam sed nunc condimentum, porta lacus in, porttitor purus. Maecenas nec enim fermentum, hendrerit ex a, tempus felis. Mauris sed diam sollicitudin, lacinia massa in, dapibus ex. Quisque nec odio sed libero pharetra mollis. Vestibulum id sodales mauris. Mauris eget tristique leo. Duis pellentesque vulputate ipsum, ut imperdiet dolor.\r\n\r\nCurabitur magna est, porta eu libero eget, eleifend ornare velit. Duis porttitor, urna quis scelerisque gravida, diam nisi congue nisl, id iaculis odio justo a quam. Nulla luctus, diam sed consectetur vestibulum, tellus dolor gravida orci, sit amet commodo nisl arcu at quam. Praesent at tellus et mauris ullamcorper ultrices in bibendum diam. Aenean a pharetra purus. Donec auctor eleifend scelerisque. Suspendisse ullamcorper ullamcorper finibus. Curabitur metus lacus, rutrum eget sagittis lacinia, lobortis non mi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in lacus eu ex tempor ultrices. Vestibulum ut nisl ut nibh eleifend pharetra ut sed tortor. Mauris in erat ac justo varius vestibulum et eu risus. Etiam non sollicitudin odio. Suspendisse ac nibh sed diam commodo tincidunt. Ut pulvinar, justo eget consequat ultricies, elit felis iaculis nisl, eu finibus magna magna nec massa.\r\n\r\nMaecenas gravida porttitor lacus, id posuere magna congue quis. Donec vel ante est. Mauris volutpat, nisi dignissim finibus sodales, est ex varius magna, eu efficitur lectus dui id sapien. Suspendisse id hendrerit dolor. Nunc non molestie nulla. Praesent at quam egestas, rutrum turpis nec, scelerisque turpis. Praesent scelerisque ipsum eget nisl tristique, in elementum lorem fermentum. Donec accumsan ante ac ante tempor iaculis. Proin risus nisi, dapibus at mollis ut, pharetra ut mauris. Donec feugiat massa eu odio mattis, sollicitudin consequat nulla cursus.\r\n\r\nMorbi egestas, quam non mattis scelerisque, turpis urna laoreet tortor, ac vehicula ex mauris quis lectus. Sed vehicula nunc eros, at efficitur augue pulvinar et. Phasellus hendrerit, nisl eu tristique mollis, sapien nibh viverra nulla, et aliquam leo est vitae elit. Morbi ornare luctus sapien sed aliquet. Maecenas a metus quam. Fusce a placerat justo. Pellentesque gravida sapien fringilla purus vehicula aliquet. Praesent viverra arcu id erat tempus, eget tempus metus pretium. Curabitur maximus condimentum tincidunt. Aenean ac libero vel ipsum placerat convallis. In et eleifend nunc. Pellentesque sit amet purus mollis nunc blandit hendrerit. Nulla vitae dignissim nulla. Vivamus eget metus quis ipsum accumsan eleifend et et nisl. Integer a dui purus.',
        'general_news_photo.jpg',
        1
    ),
    (
        2,
        'Exclusive Sale: Save Up to 50% This Weekend Only!',
        'Don\'t miss out on our weekend sale! Save big on your favorite products. Hurry, offer ends soon!',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis tortor id tempor hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent finibus diam erat, eget ultrices ante congue a. Proin sed tellus aliquet, laoreet sapien eu, sagittis lorem. Proin varius, mauris bibendum accumsan maximus, lacus diam pulvinar libero, quis aliquet lacus massa quis metus. Sed vitae mi vitae dolor eleifend consequat et at nisi. Maecenas eleifend arcu ac fringilla accumsan. Curabitur placerat leo ac mollis ultricies. Etiam lectus sem, iaculis imperdiet cursus ut, ornare mollis mauris. Suspendisse potenti. Sed id euismod purus, vitae euismod arcu. Nulla purus dolor, consequat sit amet libero sed, venenatis dapibus justo. Mauris placerat leo in consequat facilisis. Ut vestibulum eros at sem fringilla pharetra. Donec in rutrum sapien, sit amet tincidunt metus.\r\n\r\nAliquam non placerat dolor. Nullam sed nunc condimentum, porta lacus in, porttitor purus. Maecenas nec enim fermentum, hendrerit ex a, tempus felis. Mauris sed diam sollicitudin, lacinia massa in, dapibus ex. Quisque nec odio sed libero pharetra mollis. Vestibulum id sodales mauris. Mauris eget tristique leo. Duis pellentesque vulputate ipsum, ut imperdiet dolor.\r\n\r\nCurabitur magna est, porta eu libero eget, eleifend ornare velit. Duis porttitor, urna quis scelerisque gravida, diam nisi congue nisl, id iaculis odio justo a quam. Nulla luctus, diam sed consectetur vestibulum, tellus dolor gravida orci, sit amet commodo nisl arcu at quam. Praesent at tellus et mauris ullamcorper ultrices in bibendum diam. Aenean a pharetra purus. Donec auctor eleifend scelerisque. Suspendisse ullamcorper ullamcorper finibus. Curabitur metus lacus, rutrum eget sagittis lacinia, lobortis non mi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in lacus eu ex tempor ultrices. Vestibulum ut nisl ut nibh eleifend pharetra ut sed tortor. Mauris in erat ac justo varius vestibulum et eu risus. Etiam non sollicitudin odio. Suspendisse ac nibh sed diam commodo tincidunt. Ut pulvinar, justo eget consequat ultricies, elit felis iaculis nisl, eu finibus magna magna nec massa.\r\n\r\nMaecenas gravida porttitor lacus, id posuere magna congue quis. Donec vel ante est. Mauris volutpat, nisi dignissim finibus sodales, est ex varius magna, eu efficitur lectus dui id sapien. Suspendisse id hendrerit dolor. Nunc non molestie nulla. Praesent at quam egestas, rutrum turpis nec, scelerisque turpis. Praesent scelerisque ipsum eget nisl tristique, in elementum lorem fermentum. Donec accumsan ante ac ante tempor iaculis. Proin risus nisi, dapibus at mollis ut, pharetra ut mauris. Donec feugiat massa eu odio mattis, sollicitudin consequat nulla cursus.\r\n\r\nMorbi egestas, quam non mattis scelerisque, turpis urna laoreet tortor, ac vehicula ex mauris quis lectus. Sed vehicula nunc eros, at efficitur augue pulvinar et. Phasellus hendrerit, nisl eu tristique mollis, sapien nibh viverra nulla, et aliquam leo est vitae elit. Morbi ornare luctus sapien sed aliquet. Maecenas a metus quam. Fusce a placerat justo. Pellentesque gravida sapien fringilla purus vehicula aliquet. Praesent viverra arcu id erat tempus, eget tempus metus pretium. Curabitur maximus condimentum tincidunt. Aenean ac libero vel ipsum placerat convallis. In et eleifend nunc. Pellentesque sit amet purus mollis nunc blandit hendrerit. Nulla vitae dignissim nulla. Vivamus eget metus quis ipsum accumsan eleifend et et nisl. Integer a dui purus.',
        'general_news_photo.jpg',
        2
    ),
    (
        3,
        'Behind the Scenes: How We\'re Making Shopping More Sustainable',
        'Learn how we\'re working towards a greener future with eco-friendly packaging and sustainable sourcing.',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis tortor id tempor hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent finibus diam erat, eget ultrices ante congue a. Proin sed tellus aliquet, laoreet sapien eu, sagittis lorem. Proin varius, mauris bibendum accumsan maximus, lacus diam pulvinar libero, quis aliquet lacus massa quis metus. Sed vitae mi vitae dolor eleifend consequat et at nisi. Maecenas eleifend arcu ac fringilla accumsan. Curabitur placerat leo ac mollis ultricies. Etiam lectus sem, iaculis imperdiet cursus ut, ornare mollis mauris. Suspendisse potenti. Sed id euismod purus, vitae euismod arcu. Nulla purus dolor, consequat sit amet libero sed, venenatis dapibus justo. Mauris placerat leo in consequat facilisis. Ut vestibulum eros at sem fringilla pharetra. Donec in rutrum sapien, sit amet tincidunt metus.\r\n\r\nAliquam non placerat dolor. Nullam sed nunc condimentum, porta lacus in, porttitor purus. Maecenas nec enim fermentum, hendrerit ex a, tempus felis. Mauris sed diam sollicitudin, lacinia massa in, dapibus ex. Quisque nec odio sed libero pharetra mollis. Vestibulum id sodales mauris. Mauris eget tristique leo. Duis pellentesque vulputate ipsum, ut imperdiet dolor.\r\n\r\nCurabitur magna est, porta eu libero eget, eleifend ornare velit. Duis porttitor, urna quis scelerisque gravida, diam nisi congue nisl, id iaculis odio justo a quam. Nulla luctus, diam sed consectetur vestibulum, tellus dolor gravida orci, sit amet commodo nisl arcu at quam. Praesent at tellus et mauris ullamcorper ultrices in bibendum diam. Aenean a pharetra purus. Donec auctor eleifend scelerisque. Suspendisse ullamcorper ullamcorper finibus. Curabitur metus lacus, rutrum eget sagittis lacinia, lobortis non mi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in lacus eu ex tempor ultrices. Vestibulum ut nisl ut nibh eleifend pharetra ut sed tortor. Mauris in erat ac justo varius vestibulum et eu risus. Etiam non sollicitudin odio. Suspendisse ac nibh sed diam commodo tincidunt. Ut pulvinar, justo eget consequat ultricies, elit felis iaculis nisl, eu finibus magna magna nec massa.\r\n\r\nMaecenas gravida porttitor lacus, id posuere magna congue quis. Donec vel ante est. Mauris volutpat, nisi dignissim finibus sodales, est ex varius magna, eu efficitur lectus dui id sapien. Suspendisse id hendrerit dolor. Nunc non molestie nulla. Praesent at quam egestas, rutrum turpis nec, scelerisque turpis. Praesent scelerisque ipsum eget nisl tristique, in elementum lorem fermentum. Donec accumsan ante ac ante tempor iaculis. Proin risus nisi, dapibus at mollis ut, pharetra ut mauris. Donec feugiat massa eu odio mattis, sollicitudin consequat nulla cursus.\r\n\r\nMorbi egestas, quam non mattis scelerisque, turpis urna laoreet tortor, ac vehicula ex mauris quis lectus. Sed vehicula nunc eros, at efficitur augue pulvinar et. Phasellus hendrerit, nisl eu tristique mollis, sapien nibh viverra nulla, et aliquam leo est vitae elit. Morbi ornare luctus sapien sed aliquet. Maecenas a metus quam. Fusce a placerat justo. Pellentesque gravida sapien fringilla purus vehicula aliquet. Praesent viverra arcu id erat tempus, eget tempus metus pretium. Curabitur maximus condimentum tincidunt. Aenean ac libero vel ipsum placerat convallis. In et eleifend nunc. Pellentesque sit amet purus mollis nunc blandit hendrerit. Nulla vitae dignissim nulla. Vivamus eget metus quis ipsum accumsan eleifend et et nisl. Integer a dui purus.',
        'general_news_photo.jpg',
        3
    ),
    (
        4,
        'Top 5 Customer Favorites: Must-Have Products of the Month!',
        'Check out the products our customers love the most. Find your next favorite from our top picks!',
        'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sagittis tortor id tempor hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Praesent finibus diam erat, eget ultrices ante congue a. Proin sed tellus aliquet, laoreet sapien eu, sagittis lorem. Proin varius, mauris bibendum accumsan maximus, lacus diam pulvinar libero, quis aliquet lacus massa quis metus. Sed vitae mi vitae dolor eleifend consequat et at nisi. Maecenas eleifend arcu ac fringilla accumsan. Curabitur placerat leo ac mollis ultricies. Etiam lectus sem, iaculis imperdiet cursus ut, ornare mollis mauris. Suspendisse potenti. Sed id euismod purus, vitae euismod arcu. Nulla purus dolor, consequat sit amet libero sed, venenatis dapibus justo. Mauris placerat leo in consequat facilisis. Ut vestibulum eros at sem fringilla pharetra. Donec in rutrum sapien, sit amet tincidunt metus.\r\n\r\nAliquam non placerat dolor. Nullam sed nunc condimentum, porta lacus in, porttitor purus. Maecenas nec enim fermentum, hendrerit ex a, tempus felis. Mauris sed diam sollicitudin, lacinia massa in, dapibus ex. Quisque nec odio sed libero pharetra mollis. Vestibulum id sodales mauris. Mauris eget tristique leo. Duis pellentesque vulputate ipsum, ut imperdiet dolor.\r\n\r\nCurabitur magna est, porta eu libero eget, eleifend ornare velit. Duis porttitor, urna quis scelerisque gravida, diam nisi congue nisl, id iaculis odio justo a quam. Nulla luctus, diam sed consectetur vestibulum, tellus dolor gravida orci, sit amet commodo nisl arcu at quam. Praesent at tellus et mauris ullamcorper ultrices in bibendum diam. Aenean a pharetra purus. Donec auctor eleifend scelerisque. Suspendisse ullamcorper ullamcorper finibus. Curabitur metus lacus, rutrum eget sagittis lacinia, lobortis non mi. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. In in lacus eu ex tempor ultrices. Vestibulum ut nisl ut nibh eleifend pharetra ut sed tortor. Mauris in erat ac justo varius vestibulum et eu risus. Etiam non sollicitudin odio. Suspendisse ac nibh sed diam commodo tincidunt. Ut pulvinar, justo eget consequat ultricies, elit felis iaculis nisl, eu finibus magna magna nec massa.\r\n\r\nMaecenas gravida porttitor lacus, id posuere magna congue quis. Donec vel ante est. Mauris volutpat, nisi dignissim finibus sodales, est ex varius magna, eu efficitur lectus dui id sapien. Suspendisse id hendrerit dolor. Nunc non molestie nulla. Praesent at quam egestas, rutrum turpis nec, scelerisque turpis. Praesent scelerisque ipsum eget nisl tristique, in elementum lorem fermentum. Donec accumsan ante ac ante tempor iaculis. Proin risus nisi, dapibus at mollis ut, pharetra ut mauris. Donec feugiat massa eu odio mattis, sollicitudin consequat nulla cursus.\r\n\r\nMorbi egestas, quam non mattis scelerisque, turpis urna laoreet tortor, ac vehicula ex mauris quis lectus. Sed vehicula nunc eros, at efficitur augue pulvinar et. Phasellus hendrerit, nisl eu tristique mollis, sapien nibh viverra nulla, et aliquam leo est vitae elit. Morbi ornare luctus sapien sed aliquet. Maecenas a metus quam. Fusce a placerat justo. Pellentesque gravida sapien fringilla purus vehicula aliquet. Praesent viverra arcu id erat tempus, eget tempus metus pretium. Curabitur maximus condimentum tincidunt. Aenean ac libero vel ipsum placerat convallis. In et eleifend nunc. Pellentesque sit amet purus mollis nunc blandit hendrerit. Nulla vitae dignissim nulla. Vivamus eget metus quis ipsum accumsan eleifend et et nisl. Integer a dui purus.',
        'general_news_photo.jpg',
        4
    );

COMMIT;