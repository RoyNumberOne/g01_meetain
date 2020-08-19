SET SQL_SAFE_UPDATES=0;
-- use Meetain;
use meetainDataIn;
-- use meetainTest;


SELECT * FROM achievement;
desc achievement;

SELECT * FROM member;
desc member;

SELECT * FROM administrator;
desc administrator;

SELECT * FROM comment_post;
desc comment_post;

SELECT * FROM comment_report;
desc comment_report;

SELECT * FROM degree;
desc degree;

SELECT * FROM forum_keep;
desc forum_keep;

SELECT * FROM forum_post;
desc forum_post;

SELECT * FROM forum_report;
desc forum_report;

SELECT * FROM mem_achievement;
desc mem_achievement;

SELECT * FROM member;
desc member;

SELECT * FROM member_guide;
desc member_guide;
-- insert into member_guide (guide_no,mem_no,guide_period_start,guide_period_end,guide_image) value ('101061','10002','1998/5/6', date_add('1998/5/6', interval 4 year),'#');

SELECT * FROM member_keep;
desc member_keep;

SELECT * FROM member_realname;
desc member_realname;

SELECT * FROM mountain;
desc mountain;

SELECT * FROM order_list;
desc order_list;

SELECT * FROM orders;
desc orders;

SELECT * FROM product;
desc product;

SELECT * FROM product_keep;
desc product_keep;

SELECT * FROM tour;
desc tour;

SELECT * FROM tour_keep;
desc tour_keep;

SELECT * FROM tour_participate;
desc tour_participate;

SELECT * FROM tour_report;
desc tour_report;

-- select * from tour t join mountain m on t.tour_mountain = m.mountain_no where m.degree_category = 4 and m.mountain_area = 'east';
-- select * from tour t join mountain m on t.tour_mountain = m.mountain_no where m.degree_category = 4 and m.mountain_area = 'west';