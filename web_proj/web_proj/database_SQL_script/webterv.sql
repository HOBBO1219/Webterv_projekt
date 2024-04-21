-- Create database
CREATE DATABASE IF NOT EXISTS `webterv` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci;

-- Use database
USE `webterv`;

-- Table structure for table `chat`
CREATE TABLE IF NOT EXISTS `chat` (
    `messageID` int(10) NOT NULL AUTO_INCREMENT,
    `sender` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
    `receiver` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_hungarian_ci NOT NULL,
    `message_content` text NOT NULL,
    `sent_at` timestamp NOT NULL DEFAULT current_timestamp(),
    PRIMARY KEY (`messageID`),
    KEY `Sender` (`sender`),
    KEY `Receiver` (`receiver`),
    CONSTRAINT `chat_ibfk_1` FOREIGN KEY (`sender`) REFERENCES `users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `chat_ibfk_2` FOREIGN KEY (`receiver`) REFERENCES `users` (`Username`) ON DELETE CASCADE ON UPDATE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `comments`
CREATE TABLE IF NOT EXISTS `comments` (
    `CommentID` int(11) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) DEFAULT NULL,
    `PictureID` int(11) DEFAULT NULL,
    `Comment` text NOT NULL,
    `CommentedAt` timestamp NOT NULL DEFAULT current_timestamp(),
    `Likes` int(11) NOT NULL DEFAULT 0,
    PRIMARY KEY (`CommentID`),
    KEY `UserID` (`UserID`),
    KEY `PictureID` (`PictureID`),
    CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE,
    CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`PictureID`) REFERENCES `pictures` (`PictureID`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- Table structure for table `pictures`
CREATE TABLE IF NOT EXISTS `pictures` (
    `PictureID` int(11) NOT NULL AUTO_INCREMENT,
    `UserID` int(11) DEFAULT NULL,
    `Description` text DEFAULT NULL,
    `ImagePath` varchar(255) NOT NULL,
    `UploadedAt` timestamp NOT NULL DEFAULT current_timestamp(),
    `Rating` decimal(3,1) DEFAULT NULL,
    PRIMARY KEY (`PictureID`),
    KEY `UserID` (`UserID`),
    CONSTRAINT `pictures_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- Table structure for table `ratings`
CREATE TABLE IF NOT EXISTS `ratings` (
    `RatingID` int(11) NOT NULL AUTO_INCREMENT,
    `ImageSrc` varchar(255) DEFAULT NULL,
    `UserID` int(11) DEFAULT NULL,
    `Rating` int(11) DEFAULT NULL,
    PRIMARY KEY (`RatingID`),
    KEY `UserID` (`UserID`),
    CONSTRAINT `ratings_ibfk_1` FOREIGN KEY (`UserID`) REFERENCES `users` (`UserID`) ON DELETE CASCADE
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Table structure for table `users`
CREATE TABLE IF NOT EXISTS `users` (
    `UserID` int(11) NOT NULL AUTO_INCREMENT,
    `Email` varchar(255) NOT NULL,
    `Username` varchar(50) NOT NULL,
    `Password` varchar(255) NOT NULL,
    `CreatedAt` timestamp NOT NULL DEFAULT current_timestamp(),
    `UpdatedAt` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`UserID`),
    UNIQUE KEY `Email` (`Email`),
    UNIQUE KEY `Username` (`Username`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_hungarian_ci;

-- Auto-increment for table `comments`
ALTER TABLE `comments`
    MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

-- Auto-increment for table `pictures`
ALTER TABLE `pictures`
    MODIFY `PictureID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

-- Auto-increment for table `ratings`
ALTER TABLE `ratings`
    MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

-- Auto-increment for table `users`
ALTER TABLE `users`
    MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
