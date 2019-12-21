-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 01, 2019 at 01:46 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.1.32-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `cat_id` int(4) NOT NULL,
  `cat_title` varchar(255) NOT NULL,
  `cat_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`cat_id`, `cat_title`, `cat_user_id`) VALUES
(1, 'Bootstrap', 22),
(2, 'JavaScript', 29),
(5, 'HTML', 22),
(6, 'CSS', 22);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(4) NOT NULL,
  `comment_post_id` int(4) NOT NULL,
  `comment_author` varchar(255) NOT NULL,
  `comment_email` varchar(255) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_status` varchar(255) NOT NULL,
  `comment_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES
(4, 1, 'John Doe', 'john@doe.com', 'try me', 'unapproved', '2019-09-28'),
(5, 1, 'Mazhar', 'admin@admin.com', 'this is a test comment', 'unapproved', '2019-09-28'),
(7, 2, 'Ahmad', 'ahmad@gmail.com', 'I am Ahmad', 'unapproved', '2019-09-29'),
(20, 2, 'Test', 'test@admin.com', 'I\'m', 'unapproved', '2019-09-29'),
(21, 2, 'ME', 'me@me.com', 'Hey', 'unapproved', '2019-09-30'),
(22, 2, 'Sakib', 'sakib@gmail.com', 'This is sakib.', 'unapproved', '2019-09-30'),
(23, 2, 'Hello', 'hello@gmail.com', 'Hey, I\'m Hello.', 'unapproved', '2019-09-30'),
(26, 3, 'Bootstrap', 'boot@strap.com', 'this is bootstrap', 'unapproved', '2019-10-02'),
(27, 3, 'Bootstrap', 'boot@strap.com', 'this is bootstrap', 'unapproved', '2019-10-02'),
(29, 3, 'Bootstrap', 'boot@strap.com', 'this is bootstrap', 'unapproved', '2019-10-02'),
(30, 3, 'Bootstrap', 'boot@strap.com', 'this is bootstrap', 'unapproved', '2019-10-02'),
(34, 3, 'John', 'jon@doe.com', 'this is a comment', 'unapproved', '2019-10-06'),
(35, 1, 'Test', 'test@admin.com', 'JavaScript is rocks!', 'approved', '2019-10-14'),
(36, 30, 'try', 'try@gmail.com', 'boo', 'approved', '2019-10-14');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(4) NOT NULL,
  `post_category_id` int(4) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_author` varchar(255) NOT NULL,
  `post_user` varchar(255) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_image` text NOT NULL,
  `post_content` text NOT NULL,
  `post_tags` varchar(255) NOT NULL,
  `post_comments_count` int(11) DEFAULT NULL,
  `post_status` varchar(255) NOT NULL DEFAULT 'draft',
  `post_views_count` int(11) DEFAULT NULL,
  `post_likes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_category_id`, `post_title`, `post_author`, `post_user`, `post_date`, `post_image`, `post_content`, `post_tags`, `post_comments_count`, `post_status`, `post_views_count`, `post_likes`) VALUES
(1, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-05', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', 2, 'published', 135, 1),
(2, 5, 'Generating PDF from HTML with Node.js and Puppeteer', 'RisingStack', '', '2019-10-05', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', 2, 'published', 7, 0),
(3, 1, 'Bootstrap is the best CSS framework', 'Mark Otto and Jacob Thornton', '', '2019-08-09', 'bootstrap.png', 'Habitant morbi tristique senectus et netus et malesuada. Condimentum mattis pellentesque id nibh tortor id aliquet lectus proin. Praesent elementum facilisis leo vel fringilla. Turpis egestas maecenas pharetra convallis. Nisl tincidunt eget nullam non. Duis ut diam quam nulla porttitor. Convallis a cras semper auctor neque vitae tempus. Condimentum lacinia quis vel eros donec ac odio tempor orci. Sagittis orci a scelerisque purus. Molestie nunc non blandit massa enim nec dui nunc. Et magnis dis parturient montes nascetur. Enim tortor at auctor urna nunc. Feugiat nisl pretium fusce id velit ut tortor. Egestas purus viverra accumsan in nisl nisi. Faucibus turpis in eu mi. Ipsum nunc aliquet bibendum enim facilisis gravida neque convallis. Dui vivamus arcu felis bibendum. Imperdiet sed euismod nisi porta. Massa placerat duis ultricies lacus sed turpis tincidunt.', 'bootstrap', 10, 'published', 62, 2),
(4, 6, 'CSS3 - Archive the obsolete content', 'John Doe', '', '2019-09-20', 'css3.jpg', 'Sit amet mattis vulputate enim nulla aliquet porttitor. Vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. Rhoncus mattis rhoncus urna neque viverra justo nec. Quis varius quam quisque id diam vel. Id venenatis a condimentum vitae sapien. Sociis natoque penatibus et magnis dis parturient. Sit amet purus gravida quis. Fermentum posuere urna nec tincidunt praesent. Rhoncus mattis rhoncus urna neque viverra justo. Eu facilisis sed odio morbi quis commodo. Vestibulum lorem sed risus ultricies tristique nulla aliquet enim. Amet consectetur adipiscing elit duis tristique sollicitudin nibh sit.', 'css3', 1, 'published', 1, 0),
(8, 1, 'This is a test post', 'Peter Jang', '', '2019-10-10', 'linux.png', '<p>This is a test post</p>', 'test', NULL, 'published', 1, 0),
(9, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-11', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 1, 0),
(10, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-11', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 0, 0),
(11, 1, 'This is a test post', 'Peter Jang', '', '2019-10-11', 'linux.png', '<p>This is a test post</p>', 'test', NULL, 'published', 0, 0),
(12, 1, 'This is a test post', 'Peter Jang', '', '2019-10-11', 'linux.png', '<p>This is a test post</p>', 'test', NULL, 'published', 0, 0),
(13, 5, 'Generating PDF from HTML with Node.js and Puppeteer', 'RisingStack', '', '2019-10-11', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', NULL, 'published', 0, 0),
(14, 5, 'Generating PDF from HTML with Node.js and Puppeteer', 'RisingStack', '', '2019-10-11', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', NULL, 'published', 1, 0),
(16, 6, 'CSS3 - Archive the obsolete content', 'John Doe', '', '2019-10-11', 'css3.jpg', 'Sit amet mattis vulputate enim nulla aliquet porttitor. Vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. Rhoncus mattis rhoncus urna neque viverra justo nec. Quis varius quam quisque id diam vel. Id venenatis a condimentum vitae sapien. Sociis natoque penatibus et magnis dis parturient. Sit amet purus gravida quis. Fermentum posuere urna nec tincidunt praesent. Rhoncus mattis rhoncus urna neque viverra justo. Eu facilisis sed odio morbi quis commodo. Vestibulum lorem sed risus ultricies tristique nulla aliquet enim. Amet consectetur adipiscing elit duis tristique sollicitudin nibh sit.', 'css3', NULL, 'published', 0, 0),
(17, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-11', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 2, 0),
(18, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-11', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 0, 0),
(19, 6, 'CSS3 - Archive the obsolete content', 'John Doe', '', '2019-10-11', 'css3.jpg', 'Sit amet mattis vulputate enim nulla aliquet porttitor. Vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. Rhoncus mattis rhoncus urna neque viverra justo nec. Quis varius quam quisque id diam vel. Id venenatis a condimentum vitae sapien. Sociis natoque penatibus et magnis dis parturient. Sit amet purus gravida quis. Fermentum posuere urna nec tincidunt praesent. Rhoncus mattis rhoncus urna neque viverra justo. Eu facilisis sed odio morbi quis commodo. Vestibulum lorem sed risus ultricies tristique nulla aliquet enim. Amet consectetur adipiscing elit duis tristique sollicitudin nibh sit.', 'css3', NULL, 'published', 0, 0),
(20, 5, 'Generating PDF from HTML with Node.js and Puppeteer', 'RisingStack', '', '2019-10-11', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', NULL, 'published', 0, 0),
(21, 5, 'Generating PDF from HTML with Node.js and Puppeteer', 'RisingStack', '', '2019-10-11', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', NULL, 'published', 0, 0),
(22, 5, 'Generating PDF from HTML with Node.js and Puppeteer', 'RisingStack', '', '2019-10-11', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', NULL, 'published', 0, 0),
(23, 1, 'This is a test post', 'Peter Jang', '', '2019-10-11', 'linux.png', '<p>This is a test post</p>', 'test', NULL, 'published', 0, 0),
(24, 1, 'This is a test post', 'Peter Jang', '', '2019-10-11', 'linux.png', '<p>This is a test post</p>', 'test', NULL, 'published', 0, 0),
(25, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-11', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 0, 0),
(26, 2, 'Modern JavaScript Explained For Dinosaurs', 'Peter Jang', '', '2019-10-11', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 0, 0),
(27, 1, 'This is a test post', 'Peter Jang', '', '2019-10-11', 'linux.png', '<p>This is a test post</p>', 'test', NULL, 'published', 0, 0),
(28, 6, 'CSS3 - Archive the obsolete content', 'John Doe', '', '2019-10-11', 'css3.jpg', 'Sit amet mattis vulputate enim nulla aliquet porttitor. Vulputate enim nulla aliquet porttitor lacus luctus accumsan tortor posuere. Rhoncus mattis rhoncus urna neque viverra justo nec. Quis varius quam quisque id diam vel. Id venenatis a condimentum vitae sapien. Sociis natoque penatibus et magnis dis parturient. Sit amet purus gravida quis. Fermentum posuere urna nec tincidunt praesent. Rhoncus mattis rhoncus urna neque viverra justo. Eu facilisis sed odio morbi quis commodo. Vestibulum lorem sed risus ultricies tristique nulla aliquet enim. Amet consectetur adipiscing elit duis tristique sollicitudin nibh sit.', 'css3', NULL, 'draft', 1, 0),
(29, 1, 'Bootstrap is the best CSS framework', 'Mark Otto and Jacob Thornton', '', '2019-10-11', 'bootstrap.png', 'Habitant morbi tristique senectus et netus et malesuada. Condimentum mattis pellentesque id nibh tortor id aliquet lectus proin. Praesent elementum facilisis leo vel fringilla. Turpis egestas maecenas pharetra convallis. Nisl tincidunt eget nullam non. Duis ut diam quam nulla porttitor. Convallis a cras semper auctor neque vitae tempus. Condimentum lacinia quis vel eros donec ac odio tempor orci. Sagittis orci a scelerisque purus. Molestie nunc non blandit massa enim nec dui nunc. Et magnis dis parturient montes nascetur. Enim tortor at auctor urna nunc. Feugiat nisl pretium fusce id velit ut tortor. Egestas purus viverra accumsan in nisl nisi. Faucibus turpis in eu mi. Ipsum nunc aliquet bibendum enim facilisis gravida neque convallis. Dui vivamus arcu felis bibendum. Imperdiet sed euismod nisi porta. Massa placerat duis ultricies lacus sed turpis tincidunt.', 'bootstrap', NULL, 'published', 0, 0),
(30, 1, 'Generating PDF from HTML with Node.js and Puppeteer', 'Karim', 'karim', '2019-10-16', 'html5.png', '<p>At tempor commodo ullamcorper a lacus vestibulum sed. Suspendisse in est ante in. Vitae nunc sed velit dignissim sodales ut eu. Id diam maecenas ultricies mi. Convallis a cras semper auctor neque vitae tempus quam. Nunc mattis enim ut tellus. Quis auctor elit sed vulputate mi sit amet mauris commodo. Amet dictum sit amet justo donec enim. Sed elementum tempus egestas sed sed risus pretium quam. Neque egestas congue quisque egestas diam in. Viverra suspendisse potenti nullam ac tortor vitae purus faucibus.</p>', 'html', NULL, 'published', 1, 0),
(31, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-16', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', 4, 0),
(34, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', NULL, 0),
(35, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', '', NULL, 'published', 5, 0),
(39, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', 'javascript', NULL, 'published', NULL, 0),
(40, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', '', NULL, 'published', 5, 0),
(42, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', '', NULL, 'published', 5, 0),
(43, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', '', NULL, 'unpublished', 5, 0),
(44, 1, 'Modern JavaScript Explained For Dinosaurs', '', 'amar', '2019-10-19', 'JavaScript.jpg', '<h2><strong>Hello</strong></h2><p>Augue interdum velit <strong>euismod</strong> in <i>pellentesque</i> massa placerat duis. Dictum varius duis at consectetur lorem donec massa sapien faucibus. Massa tincidunt dui ut ornare. Tortor at risus viverra adipiscing at. Interdum consectetur libero id faucibus nisl tincidunt eget nullam. Felis bibendum ut tristique et egestas. Elementum tempus egestas sed sed risus pretium quam vulputate dignissim. Vulputate ut pharetra sit amet aliquam id diam. Aliquet eget sit amet tellus. Fringilla phasellus faucibus scelerisque eleifend donec pretium vulputate sapien. Ut porttitor leo a diam sollicitudin tempor id. Enim sit amet venenatis urna cursus eget. Id semper risus in hendrerit gravida rutrum quisque. Nibh venenatis cras sed felis eget velit. Turpis egestas sed tempus urna et.</p>', '', NULL, 'published', 5, 0),
(45, 1, 'Book is the best friend', 'admin', 'admin', '2019-10-27', 'photo-1570171278960-d6c2b316f3b1.jpeg', '<p>This is a book</p>', 'book', NULL, 'published', NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(4) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_firstname` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_image` text,
  `user_role` varchar(255) NOT NULL,
  `user_randSalt` varchar(255) DEFAULT '$2a$07$usesomesillystringforsalt$',
  `token` text,
  `user_status` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_password`, `user_firstname`, `user_lastname`, `user_email`, `user_image`, `user_role`, `user_randSalt`, `token`, `user_status`) VALUES
(22, 'admin', '$2y$15$11KtVXA0hgno2RChrV4AOOREsDgDSrTahUH/Ez6GVyQIcX3xTwQYe', 'I am', 'Admin', 'admin@admin.com', 'male.jpg', 'admin', '$2a$07$usesomesillystringforsalt$', '', 'approved'),
(24, 'jamal', '$2y$15$R36pINROoYkpVSCCYjwKzeqsW101YhMYq065FjwZT73K9vgMbY0Bm', NULL, NULL, 'jamal@gmail.com', NULL, 'subscriber', '$2a$07$usesomesillystringforsalt$', '', 'approved'),
(29, 'karim', '$2y$15$R6LWuSk8QdpD6uUjCmOtDehRAfh6TvxmMBFYcB7LQWz5VgRg4Dzre', NULL, NULL, 'karim@gmail.com', NULL, 'admin', '$2a$07$usesomesillystringforsalt$', '', 'approved'),
(30, 'rahim', '$2y$15$qMreagmn9JFz5HtWdp1wzeDF0mVwj9IISKpREHu42PjRyw4lnD1dm', NULL, NULL, 'rahim@gmail.com', NULL, 'subscriber', '$2a$07$usesomesillystringforsalt$', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_online`
--

CREATE TABLE `users_online` (
  `id` int(11) NOT NULL,
  `session` varchar(255) NOT NULL,
  `time` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_online`
--

INSERT INTO `users_online` (`id`, `session`, `time`) VALUES
(2, 'alitf9jopu43tnk2v5c1181lnj', 1572615977),
(3, '5thq3j65a75od99prkugpica72', 1570901623),
(4, 'uk3dtbpuv3m0a22gpl5vlk936j', 1570985783),
(5, '70b4q84ikq28ntgbs44m62h6ro', 1570988673),
(6, '2rqodk05k2jlka8ls1ss1h524n', 1571014268),
(7, 'tkhbv3s13h0goet6m81k0rc20k', 1571015297),
(8, '5l2bc22osk9ui0gagdttl3fpvu', 1571015462),
(9, 'sagr736gcnpkgla7v60n5q0unm', 1572455135);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `users_online`
--
ALTER TABLE `users_online`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `cat_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
--
-- AUTO_INCREMENT for table `users_online`
--
ALTER TABLE `users_online`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
