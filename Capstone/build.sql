DROP TABLE IF EXISTS emailNotification CASCADE;
DROP TABLE IF EXISTS timeSlots CASCADE;
DROP TABLE IF EXISTS nearbyLocations CASCADE;
DROP TABLE IF EXISTS applicationForm CASCADE;
DROP TABLE IF EXISTS reviews CASCADE;
DROP TABLE IF EXISTS transaction CASCADE;
DROP TABLE IF EXISTS parkingLocation CASCADE;
DROP TABLE IF EXISTS users CASCADE;
DROP TABLE IF EXISTS admin CASCADE;



create table admin (
    employeeID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(300) NOT NULL,
    fname VARCHAR(25) NOT NULL,
    lname VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(14) NOT NULL,
    accessLevel INT(2),
    PRIMARY KEY (employeeID)
) ENGINE = innodb;

create table users (
    userID INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(25) NOT NULL,
    password VARCHAR(300) NOT NULL,
    fname VARCHAR(25) NOT NULL,
    lname VARCHAR(25) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone VARCHAR(14) NOT NULL,
    car VARCHAR(30) NOT NULL,
    plateNum VARCHAR(20) NOT NULL,
    areSeller INT(2),
    PRIMARY KEY (userID)
) ENGINE = innodb;



create table parkingLocation (
    parkingID INT NOT NULL AUTO_INCREMENT,
    ownerID INT,
    address VARCHAR(100),
    zip MEDIUMINT(5) ZEROFILL,
    longitude DECIMAL(11,8),
    latitude DECIMAL(10,8),
    active INT,
    price DECIMAL(5,2),
    notesByRentor VARCHAR(200),
    PRIMARY KEY (parkingID),
    FOREIGN KEY (ownerID) references users(userID)
   
) ENGINE = innodb;

create table transaction (
    transactionID INT NOT NULL AUTO_INCREMENT,
    userID INT,
    parkingID INT,
    timeFrame TIME,
    date DATE,
    status VARCHAR(10),
    PRIMARY KEY (transactionID),
    FOREIGN KEY (userID) references users(userID),
    FOREIGN KEY (parkingID) references parkingLocation(parkingID)
   
) ENGINE = innodb;


create table reviews (
    reviewID INT NOT NULL AUTO_INCREMENT,
    userID INT,
    parkingID INT,
    stars SMALLINT NOT NULL CHECK (1<= stars <= 5),
    description VARCHAR (400) NOT NULL,
    date DATE,
    PRIMARY KEY (reviewID),
    FOREIGN KEY (userID) references users(userID),
    FOREIGN KEY (parkingID) references parkingLocation(parkingID)
   
) ENGINE = innodb;

create table applicationForm (
    appID INT NOT NULL AUTO_INCREMENT,
    userID INT,
    date_of_birth DATE,
    password VARCHAR(300) NOT NULL,
    address VARCHAR(100),
    zip MEDIUMINT(5) ZEROFILL,       
    price DECIMAL(5,2),
    notesByRentor VARCHAR(200), 
    active VARCHAR(8),
    PRIMARY KEY (appID),
    FOREIGN KEY (userID) references users(userID)

) ENGINE = innodb;

create table nearbyLocations (
    nearbyID INT,
    name VARCHAR (40),
    longitude DECIMAL(9,6),
    latitude DECIMAL(9,6), 
    listedOnSite INT,      
    FOREIGN KEY (nearbyID) references parkingLocation(parkingID)    

) ENGINE = innodb;

create table timeSlots(
    parkingID INT,
    startTime TIME,
    endTime TIME,
    dateAvaliable DATE,
    status VARCHAR (9),
    FOREIGN KEY (parkingID) references parkingLocation(parkingID)
    
)
    ENGINE = innodb;

create table emailNotification (
    userID INT,
    appID INT,
    transactionID INT,
    dateSent DATE,
    arriving TIME,
    leaving TIME,
    FOREIGN KEY (userID) references users(userID),
    FOREIGN KEY (appID) references applicationForm(appID),
    FOREIGN KEY (transactionID) references transaction(transactionID)

    

) ENGINE = innodb;

-- Everything Commented out can simplely be found by linking with the other tables

    -- address VARCHAR(100),
    --username VARCHAR(25) NOT NULL, 
    --userPhone VARCHAR(14) NOT NULL,
    --email VARCHAR(50) NOT NULL,
    --car VARCHAR(20) NOT NULL,
    --plateNum VARCHAR(20) NOT NULL,
    --price DECIMAL(5,2),
    --rentName VARCHAR(25) NOT NULL, 
    --rentPhone VARCHAR(14) NOT NULL,
    --notesByRentor VARCHAR(200),

INSERT INTO admin (employeeID, username, password, fname, lname, email, phone, accessLevel) VALUES
    (1,'hshinkle','6WQ4fzfb','Hinkle','Harrison','hshinkle@iu.edu','812-320-2503',1),
    (2,'dk67','hcNp9npbB','Kim','Donghwan','dk67@iu.edu','812-320-2114',1),
    (3,'yk14','kUxhbT','Kim','Yongzun','yk14@iu.edu','812-360-7728',1);



INSERT INTO users (userID, username, password, fname, lname, email, phone, car, plateNum, areSeller) VALUES
    (1, 'zglanders0', 'zPQja5h', 'Zora', 'Glanders', 'zglanders0@youtube.com', '617-727-7023', 'SRX', 'ML8M9F', 0),
    (2, 'afagg1', 'zvB2YVc7a4r5', 'Angel', 'Fagg', 'afagg1@biglobe.ne.jp', '254-820-8926', 'S-Class', 'VFVFJ1', 0),
    (3, 'ctiffany2', 'BhOyY3JVBImv', 'Cynthea', 'Tiffany', 'ctiffany2@tamu.edu', '480-215-0817', 'Reventón', 'H8X3Y5', 1),
    (4, 'cdegoe3', '1Tu3Nl', 'Corabelle', 'Degoe', 'cdegoe3@java.com', '559-903-6217', 'Grand Prix', 'G1T0N3', 1),
    (5, 'scrush4', 'a5BVbdE9Fz', 'Shena', 'Crush', 'scrush4@tinypic.com', '295-772-6651', 'Silverado 1500', 'YJQEN8', 1),
    (6, 'meary5', 'OGNsWt6', 'Merralee', 'Eary', 'meary5@mashable.com', '564-439-7044', '350Z', 'OVGWNH', 1),
    (7, 'amcdonand6', 'FGsCoNcB2l57', 'Ardath', 'McDonand', 'amcdonand6@cdbaby.com', '724-378-5849', 'Thunderbird', 'NCWL50', 1),
    (8, 'cley7', 'D7g8hZeX0HU', 'Cordie', 'Ley', 'cley7@si.edu', '463-567-8177', 'E350', 'FG4RPB', 8),
    (9, 'abrangan8', '0Q3A6VAGXocH', 'Alfons', 'Brangan', 'abrangan8@nifty.com', '446-409-6435', 'Yukon XL 2500', 'JCASWX', 1),
    (10, 'msandcroft9', 'uhK30sK', 'Monti', 'Sandcroft', 'msandcroft9@tumblr.com', '654-882-5520', 'Roadster', 'PX2DDT', 1),
    (11, 'bbreyta', 'iFfoyXeD81Be', 'Barbey', 'Breyt', 'bbreyta@paginegialle.it', '125-267-2829', 'Quest', '9T2VTK', 1),
    (12, 'dpicklesb', 'LLqTos7n0', 'Drucie', 'Pickles', 'dpicklesb@theglobeandmail.com', '590-920-0033', 'Swift', 'WTUF1Q', 0),
    (13, 'sblannc', 'uZtdwpi81LVy', 'Sharl', 'Blann', 'sblannc@nymag.com', '854-368-7659', 'RAV4', '7WRWUM', 1),
    (14, 'dmcelweed', 'EDpP5bl', 'Doloritas', 'McElwee', 'dmcelweed@cam.ac.uk', '969-749-7294', 'Suburban 1500', 'PM0PE7', 1),
    (15, 'ntimberlakee', 'QWG87wPsig', 'Norton', 'Timberlake', 'ntimberlakee@fotki.com', '733-273-9751', 'Eclipse', 'FFPF5X', 0),
    (16, 'scarissf', 'NXuNvqR2M', 'Sofie', 'Cariss', 'scarissf@baidu.com', '629-613-1586', 'Suburban 2500', 'SE6FZ3', 1),
    (17, 'elidgertwoodg', '3MF3WMATCEO0', 'Elva', 'Lidgertwood', 'elidgertwoodg@nba.com', '537-250-1043', 'Excursion', 'SU1QWF', 1),
    (18, 'ltrimmeh', 'K7c1MFTnvf', 'Lindsey', 'Trimme', 'ltrimmeh@ca.gov', '107-710-0403', 'Land Cruiser', 'VTLE3K', 1),
    (19, 'mivashchenkoi', 'f3kP9numCAAq', 'Melinda', 'Ivashchenko', 'mivashchenkoi@weibo.com', '212-743-4977', 'MX-6', 'MUWFL2', 1),
    (20, 'revreuxj', 'nCbKAH7qRsB', 'Rycca', 'Evreux', 'revreuxj@businessinsider.com', '266-483-5210', 'Tercel', '4LZKHC', 1),
    (21, 'bjuschkak', 'RYTFgJf6e', 'Belita', 'Juschka', 'bjuschkak@geocities.jp', '863-166-3159', 'Bronco', 'NTWN23', 1),
    (22, 'xbrennonl', 'cgOx4aG82', 'Ximenez', 'Brennon', 'xbrennonl@google.fr', '330-702-9791', 'B-Series', 'GLAR0F', 1),
    (23, 'pvanniekerkm', 'BIxmbz6b', 'Pren', 'Van Niekerk', 'pvanniekerkm@answers.com', '674-148-9330', 'Tiburon', 'HQTOFJ', 1),
    (24, 'fpevsnern', 'Hj30i9qN', 'Fabe', 'Pevsner', 'fpevsnern@usnews.com', '162-555-4250', 'Expedition', 'GH756K', 1),
    (25, 'kseedmano', 'Qq8tKmqXaS', 'Karry', 'Seedman', 'kseedmano@surveymonkey.com', '446-433-5924', 'Yukon XL 1500', 'YLTRQC', 1),
    (26, 'swelbeckp', 'C0NyKgs', 'Sidney', 'Welbeck', 'swelbeckp@jugem.jp', '403-516-6937', 'Breeze', '1MWWV0', 1),
    (27, 'grainfordq', 'NnZhAG', 'Giselle', 'Rainford', 'grainfordq@gmpg.org', '239-779-6817', 'V40', 'C905E5', 1),
    (28, 'zpeizerr', 'GS6Cs8kI', 'Zita', 'Peizer', 'zpeizerr@hostgator.com', '707-609-5014', 'Elantra', '9AU99Y', 1),
    (29, 'gmartinuzzis', 'YLp8rkZu', 'Giles', 'Martinuzzi', 'gmartinuzzis@flavors.me', '451-215-1007', 'Suburban 1500', 'NDS2YO', 1),
    (30, 'atwinborought', '2JoKdGFdqCex', 'Aurea', 'Twinborough', 'atwinborought@cbsnews.com', '266-238-5281', 'MDX', 'GR7ZGA', 1),
    (31, 'atwinborought', '2JoKdGFdqCex', 'Aurea', 'Twinborough', 'dandy0425@naver.com', '266-238-5281', 'MDX', 'GR7ZGA', 1),
    (32, 'atwinborought', '2JoKdGFdqCex', 'Aurea', 'Twinborough', 'dandy0425@naver.com', '266-238-5281', 'MDX', 'GR7ZGA', 1),
    (33, 'atwinborought', '123123', 'Aurea', 'Twinborough', 'yk970425@gmail.com', '266-238-5281', 'MDX', 'GR7ZGA', 1);
INSERT INTO parkingLocation(parkingID, ownerID, address, zip, longitude, latitude, active, price, notesByRentor) VALUES 
    (1, 1, "700 N Woodlawn Ave", 47408, -86.52330, 39.17276, 1, 6.50, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (2, 2, "150 S Woodlawn Ave", 47405, -86.52358, 39.16537, 1, 5.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (3, 8, "1020 E Kirkwood Ave", 47405, -86.52101, 39.16622, 1, 7.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (4, 12, "1133 E 7th St", 47405, -86.51977, 39.16929, 1, 3.99, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (5, 15, "355 N Jordan Ave", 47405, -86.51722, 39.16965, 1, 5.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (6, 16, "900 E 7th St ", 47405, -86.52371, 39.16782, 0, 0, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (7, 17, "1275 E 10th St,", 47405, -86.51937, 39.17246, 1, 3.99, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (8, 20, "1320 E 10th St", 47405, -86.51678, 39.17108, 1, 8.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (9, 23, "1025 E 7th St", 47405, -86.52132, 39.17013, 1, 5.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (10, 24, "1211 E 7th St", 47405, -86.51814, 39.16861, 1, 3.99, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (11, 25, "701 E 17th St", 47408, -86.52626, 39.17963, 1, 5.99, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (12, 26, "1000 N Fee Ln", 47406, -86.51809, 39.17528, 1, 4.99, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (13, 27, "N Campbell St", 47406, -86.51409, 39.17036, 0, 0, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (14, 29, "1001 E 17th St", 47408, -86.52214, 39.18105, 0, 8.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (15, 30, "940 E 7th St", 47405, -86.52265, 39.16845, 1, 3.00, 'Morbi vel lectus in quam fringilla rhoncus.'),
    (16, 33, "940 E 7th St", 47405, -86.52265, 39.16845, 1, 3.00, 'Morbi vel lectus in quam fringilla rhoncus.');
    
INSERT INTO transaction (transactionID, userID, parkingID, timeFrame, date, status) VALUES
    (1, 33, 8, '3:00','2022-12-21','cancelled'),
    (2, 6, 1, '11:00','2022-12-21', 'completed'),
    (3, 11, 12, '4:30','2022-12-21', 'cancelled'),
    (4, 12, 15, '9:00','2022-12-21', 'completed');

INSERT INTO reviews (reviewID, userID, parkingID, stars, description, date) VALUES 
    (1, 2, 7, 3, 'Donec quis orci eget orci vehicula condimentum. Curabitur in libero ut massa volutpat convallis. Morbi odio odio, elementum eu, interdum eu, tincidunt in, leo.', '2022-06-20'),
    (2, 4, 3, 2, 'Quisque erat eros, viverra eget, congue eget, semper rutrum, nulla.', '2022-06-09'),
    (3, 9, 10, 3, 'Maecenas rhoncus aliquam lacus. Morbi quis tortor id nulla ultrices aliquet. Maecenas leo odio, condimentum id, luctus nec, molestie sed, justo. Pellentesque viverra pede ac diam. Cras pellentesque volutpat dui. Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc.', '2022-11-21'),
    (4, 11, 12, 2, 'Donec ut dolor. Morbi vel lectus in quam fringilla rhoncus. Mauris enim leo, rhoncus sed, vestibulum sitet, cursus id, turpis.', '2022-05-14'),
    (5, 14, 1, 1, 'Integer aliquet, massa id lobortis convallis, tortor risus dapibus augue, vel accumsan tellus nisi eu orci. Mauris lacinia sapien quis libero. Nullam sitet turpis elementum ligula vehicula consequat. Morbi a ipsum. Integer a nibh. In quis justo.', '2022-10-09'),
    (6, 2, 8, 1, 'Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Mauris viverra diam vitae quam. Suspendisse potenti. Nullam porttitor lacus at turpis. Donec posuere metus vitae ipsum. Aliquam non mauris.', '2022-07-17'),
    (7, 2, 14, 1, 'Donec semper sapien a libero. Nam dui. Proin leo odio, porttitor id, consequat in, consequat ut, nulla.', '2022-10-16'),
    (8, 9, 14, 1, 'Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sitet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Nulla dapibus dolor vel est.', '2022-09-21'),
    (9, 18, 13, 5, 'Nulla facilisi. Cras non velit nec nisi vulputate nonummy. Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', '2022-11-24'),
    (10, 22, 1, 4, 'Nullam molestie nibh in lectus. Pellentesque at nulla. Suspendisse potenti. Cras in purus eu magna vulputate luctus. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.', '2022-03-27'),
    (11, 28, 1, 3, 'Vestibulum rutrum rutrum neque. Aenean auctor gravida sem. Praesent id massa id nisl venenatis lacinia. Aenean sitet justo. Morbi ut odio.', '2022-06-14'),
    (12, 7, 4, 1, 'Aenean fermentum. Donec ut mauris eget massa tempor convallis. Nulla neque libero, convallis eget, eleifend luctus, ultricies eu, nibh. Quisque id justo sitet sapien dignissim vestibulum. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae, Nulla dapibus dolor vel est.', '2022-02-03');




INSERT INTO applicationForm (appID, userID, date_of_birth, password, address, zip, price, notesByRentor, active) VALUES
    (1, 1, '2001-02-24', 'Ssi4pE8g3xo', '61 West Drive', 47403, 3.44, 'Morbi vel lectus in quam fringilla rhoncus.', 'active'),
    (2, 2, '2002-05-31', '2PDbLCWo', '70641 Erie Point', 47403, 15.45, 'Maecenas tristique, est et tempus semper, est quam pharetra magna, ac consequat metus sapien ut nunc. Vestibulum ante ips.', 'inactive'),
    (3, 3, '2002-04-29', 'nGu9jx9', '677 Sachtjen Circle', 47408, 9.7, 'Pellentesque at nulla.', 'active'),
    (4, 4, '2002-01-17', 'K5VB7orA1PPx', '0 Park Meadow Place', 47408, 14.95, 'Phasellus id sapien in sapien iaculis congue. Vivamus metus arcu, adipiscing molestie, hendrerit at, vulputate vitae, nisl.', 'active'),
    (5, 5, '2001-09-16', 'utRKrCws', '351 Gerald Junction', 47405, 9.44, 'Proin interdum mauris non ligula pellentesque ultrices.', 'active'),
    (6, 6, '2001-11-25', 'AUbzVRb7A', '634 Esker Hill', 47403, 14.47, 'Proin eu mi. Nulla ac enim.', 'active'),
    (7, 7, '2002-12-01', 'EzMzybaug9', '03 Schiller Court', 47402, 7.99, 'Vivamus tortor. Duis mattis egestas metus.', 'active'),
    (8, 8, '2002-09-06', 'As74fOJhRHM8', '9 Ryan Alley', 47408, 16.99,'Ut tellus.', 'inactive'),
    (9, 9, '2002-02-22', 'YlrzPYP', '810 Grasskamp Lane', 47408, 5.46, 'Nulla tempus. Vivamus in felis eu sapien cursus vestibulum.', 'active'),
    (10, 10, '2001-03-20', 'XNQnfC', '817 Coolidge Avenue', 47403, 16.15, 'Pellentesque ultrices mattis odio. Donec vitae nisi.', 'inactive'),
    (11, 11, '2001-06-13', '4oMQhKJ1i9', '1 Merrick Trail', 47404, 3.21, 'Sed vel enim sitet nunc viverra dapibus.', 'active'),
    (12, 12, '2001-08-13', 'Ek1yFJ', '5663 Rieder Park', 47408, 1.36, 'Proin at turpis a pede posuere nonummy.', 'inactive'),
    (13, 13, '2002-01-01', 'NXocep', '65186 Northfield Parkway', 47401, 10.23, 'Vestibulum rutrum rutrum neque. Aenean auctor gravida sem.', 'active'),
    (14, 14, '2002-10-08', 'BaHAmC9LVyH7', '951 Lake View Way', 47401, 15.75, 'Maecenas tincidunt lacus at velit. Vivamus vel nulla eget eros elementum pellentesque.', 'inactive'),
    (15 ,15, '2001-12-31', 'V9GhNoe0', '524 Northfield Center', 47402, 11.78, 'Curabitur convallis. Duis consequat dui nec nisi volutpat eleifend.', 'active'),
    (16 ,31, '2001-12-31', 'V9GhNoe0', '524 Northfield Center', 47402, 11.78, 'Curabitur convallis. Duis consequat dui nec nisi volutpat eleifend.', 'active');
    
--INSERT INTO nearbyLocations (nearbyID name, longitude, latitude, active) VALUES

INSERT INTO timeSlots (parkingID, startTime, endTime, dateAvaliable, status) VALUES
    (6, '4:00', '5:00', '2023-10-12', 'available'),
    (15, '9:0', '10:00', '2023-11-10', 'available'),
    (13, '11:00', '12:00', '2023-07-10', 'taken'),
    (5, '12:00', '1:00', '2023-10-07', 'taken'),
    (7, '4:00', '5:00', '2023-04-23', 'available'),
    (15, '7:00', '8:00', '2023-09-04', 'available'),
    (14, '8:00', '9:00', '2023-04-28', 'available'),
    (9, '6:00', '7:00', '2023-05-22', 'available'),
    (2, '6:00', '7:00', '2023-08-27', 'available'),
    (2, '5:00', '6:00', '2023-10-03', 'taken'),
    (10, '10:00', '11:00', '2023-02-13', 'taken'),
    (10, '3:00', '4:00', '2023-11-20', 'available'),
    (12, '4:00', '5:00', '2023-07-25', 'taken'),
    (2, '6:00', '7:00', '2023-08-17', 'taken'),
    (3, '4:00', '5:00', '2023-07-24', 'taken'),
    (12, '12:00', '1:00', '2023-10-27', 'taken'),
    (9, '6:00', '7:00', '2023-05-08', 'available'),
    (9, '4:00', '5:00', '2023-11-23', 'taken'),
    (4, '7:00', '8:00', '2023-11-29', 'available'),
    (1, '12:00', '1:00', '2023-01-16', 'taken'),
    (9, '9:00', '10:00', '2023-05-09', 'taken'),
    (10, '9:00', '10:00', '2023-04-27', 'available'),
    (6, '5:00', '6:00', '2023-09-27', 'taken'),
    (3, '1:00', '2:00', '2023-08-15', 'taken'),
    (5, '11:00', '12:00', '2023-04-30', 'available'),
    (10, '2:00', '3:00', '2023-09-23', 'available'),
    (8, '4:00', '5:00', '2023-10-01', 'taken'),
    (8, '4:00', '5:00', '2023-08-07', 'available'),
    (13, '6:00', '7:00', '2023-12-22', 'taken'),
    (7, '3:00', '4:00', '2023-11-08', 'available');


SET FOREIGN_KEY_CHECKS=0; --needed to not crash the table
INSERT INTO emailNotification (appID, userID, transactionID, dateSent ,arriving, leaving) VALUES

    (1, 24, 3, '2022-09-08', '9:29', '5:42'),
    (2, 29, 2, '2022-12-15', '10:16', '6:30'),
    (3, 30, 1, '2023-01-04', '4:12', '7:16'),
    (4, 25, 3, '2023-02-11', '6:44', '6:45'),
    (5, 8, 4, '2022-04-10', '11:48', '11:25'),
    (6, 8, 2,'2022-12-10', '12:26', '2:24'),
    (7, 20, 2,'2022-04-07', '8:24', '12:34'),
    (8, 14, 1,'2022-10-30', '4:55', '6:44'),
    (9, 19, 4,'2022-10-25', '3:34', '4:00'),
    (10, 1, 3,'2023-01-13', '2:22', '12:08'),
    (11, 25, 2,'2022-08-20', '1:28', '3:47'),
    (12, 7, 2,'2022-03-24', '8:44', '9:34'),
    (13, 23, 3, '2022-03-05', '11:22', '2:46'),
    (14, 20, 3, '2022-05-12', '6:07', '11:53'),
    (15, 24, 2, '2022-08-29', '1:05', '8:44'),
    (16, 31, 1, '2022-08-29', '1:05', '8:44'),
    (17, 33, 4, '2022-08-29', '1:05', '8:44');


