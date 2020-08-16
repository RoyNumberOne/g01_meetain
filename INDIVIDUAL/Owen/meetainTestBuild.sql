SET SQL_SAFE_UPDATES=0;
use MeetainDataIn;

CREATE TABLE IF NOT EXISTS achievement (									-- :::::徽章::::: 
    `achievement_no` 		int				primary key auto_increment,		-- 成就編號
    `achievement_category` 	varchar(30)		not null,						-- 成就類別
    `achievement_name` 		varchar(30)		not null,						-- 成就名稱
    `achievement_require` 	int				not null,						-- 成就限制
    `achievement_image` 	varchar(200)	not null default'default'		-- 成就圖片
) ;
alter table achievement auto_increment = 1;
desc achievement;
select * from achievement;

CREATE TABLE IF NOT EXISTS member (											-- :::::會員::::: 
    `mem_no` 				INT				primary key auto_increment ,	-- 會員編號
    `mem_id` 				varchar (24)	not null unique,				-- 會員暱稱	
    `mem_name` 				varchar (18) 	not null,						-- 會員姓名 
    `mem_acc` 				varchar (15) 	not null unique,				-- 會員帳號 
    `mem_psw` 				varchar (15) 	not null,						-- 會員密碼 
    `mem_mail` 				varchar (50) 	not null,						-- 會員信箱
    `mem_build` 			datetime	 	not null default current_timestamp,		-- 加入日期
    `mem_point` 			int				not null default'0',			-- 會員點數 
	`total_post`	 		Int				not null default'0',			-- 會員發文次數 
    `total_host` 			Int				not null default'0',			-- 會員開團次數
	`total_join` 			Int				not null default'0',			-- 會員參團次數 
	`ban_forum` 			Boolean			not null default'0',			-- 會員討論區禁言 
	`ban_forum_date` 		datetime		,								-- 會員討論區解除禁言日期
	`ban_tour` 				Boolean			not null default'0',			-- 會員揪團區禁言
	`ban_tour_date`			datetime		,								-- 會員揪團區禁言解禁日期
	`mem_avator`			Varchar(200)	not null default'default',		-- 會員大頭貼位子
	`mem_bg`				Varchar(200)	not null default'default',		-- 會員背景圖片位子
    `mem_badge1`			int				,								-- 徽章秀1
    `mem_badge2`			int				,								-- 徽章秀2
    `mem_badge3`			int				,								-- 徽章秀3
	`mem_point_forumpost`	Int				not null default'0',			-- 會員點數from討論區
	`mem_point_tourhost`	Int				not null default'0',			-- 會員點數from開團
	`mem_point_tourjoin`	Int				not null default'0',			-- 會員點數from參團
	`mem_point_game`		Int				not null default'0',			-- 會員點數from遊戲
    `class`					Boolean			default'0',						-- 0一般會員 1管理員 
	foreign key (`mem_badge1`) references achievement(`achievement_no`) on delete set null on update set null,
	foreign key (`mem_badge2`) references achievement(`achievement_no`) on delete set null on update set null,
	foreign key (`mem_badge3`) references achievement(`achievement_no`) on delete set null on update set null
) ;
alter table member auto_increment = 10001;
desc member;
select * from member;

CREATE TABLE IF NOT EXISTS administrator (									-- :::::管理員::::: 
    `admin_no` 				int				primary key auto_increment,		-- 管理員編號
    `admin_id` 				varchar(24)		not null unique,				-- 管理員暱稱
    `admin_name` 			varchar(18)		not null,						-- 管理員姓名
    `admin_acc` 			varchar(15)		not null unique,				-- 管理員帳號		
    `admin_psw` 			varchar(15)		not null,						-- 管理員密碼
    `admin_mail` 			varchar(50)		not null,						-- 管理員信箱
    `admin_authority` 		Boolean			not null default'1',			-- 管理員權限 1有權限 0停權
    `admin_build` 			datetime		not null default current_timestamp		-- 加入時間
);
alter table administrator auto_increment = 1;
desc administrator;
select * from administrator;

CREATE TABLE IF NOT EXISTS degree (											-- :::::難度::::: 
    `degree_category` 		int				primary key not null,			-- 難度等級 1最簡單4最難
    `degree_describe`	 	varchar(10)		not null						-- 難度敘述 easy => 1 | normal => 2 | hard => 3 | expert => 4
) ;
desc degree;
select * from degree;

CREATE TABLE IF NOT EXISTS mountain (										-- :::::山::::: 
    `mountain_no` 			int				primary key auto_increment,		-- 山的編號
    `degree_category` 		int				not null,						-- 山的難度等級
    `mountain_name` 		varchar(30)		not null,						-- 山的名字
    `mountain_latitude` 	varchar(30)		not null,						-- 山的緯度
    `mountain_longitude` 	varchar(30)		not null,						-- 山的經度
    `mountain_area` 		varchar(30)		not null,						-- 山的地區 (北/西/南/東)
    `mountain_image` 		varchar(200)	not null default'default',		-- 山的圖片
    foreign key (`degree_category`) references degree(`degree_category`) on delete cascade on update cascade
) ;
alter table mountain auto_increment = 1;
desc mountain;
select * from mountain;

CREATE TABLE IF NOT EXISTS member_keep (									-- :::::會員追蹤::::: 
    `mem_keep_mem` 			int			 	not null,						-- "誰"追蹤
    `mem_iskept_mem` 		int				not null,						-- 追蹤"誰"
    foreign key (`mem_keep_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`mem_iskept_mem`) references member(`mem_no`) on delete cascade on update cascade,
    constraint member_keep primary key (`mem_keep_mem` , `mem_iskept_mem`)
) ;
desc member_keep;
select * from member_keep;

CREATE TABLE IF NOT EXISTS member_realname (								-- :::::實名制認證::::: 
    `mem_idno` 				char(10)		primary key not null,			-- 身分證字號
    `mem_no` 				int				not null,						-- 會員編號
    `mem_realname` 			varchar(18)		not null,						-- 真實姓名
    `mem_idno_image` 		varchar(200)	not null,						-- 證件照片
    foreign key (`mem_no`) references member(`mem_no`) on delete cascade on update cascade
) ;
desc member_realname;
select * from member_realname;


CREATE TABLE IF NOT EXISTS member_guide (									-- :::::嚮導認證::::: 
    `guide_no` 				varchar(25)		primary key not null,			-- 嚮導證編號
    `mem_no` 				int				not null,						-- 會員編號
    `guide_period_start` 	date			not null,						-- 嚮導證發證日期
    `guide_period_end` 		date			not null,						-- 嚮導證有效日期
    `guide_image` 			varchar(200)	not null,						-- 身分證照片
    foreign key (`mem_no`) references member(`mem_no`) on delete cascade on update cascade
) ;
desc member_guide;
select * from member_guide;

CREATE TABLE IF NOT EXISTS mem_achievement (								-- :::::擁有成就::::: 
    `mem_no` 				int				not null,						-- 會員編號
    `achievement_no` 		int				not null,						-- 成就編號
    `achievement_date` 		datetime			not null default current_timestamp,						-- 獲得成就日期
    foreign key (`mem_no`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`achievement_no`) references achievement(`achievement_no`) on delete cascade on update cascade,
    constraint mem_achievement primary key (`mem_no` , `achievement_no`)
) ;
desc mem_achievement;
select * from mem_achievement;


CREATE TABLE IF NOT EXISTS product (											-- :::::商城商品::::: 
    `product_no` 				int				primary key auto_increment,		-- 商品編號
    `degree_category` 			int				not null,						-- 商品難度等級
    `product_category` 			Varchar(30)		not null,						-- 商品類別		
    `product_name` 				Varchar(60)		not null,						-- 商品名稱
    `product_price` 			Int				not null,						-- 商品價格
    `product_description` 		Varchar(600)	not null,						-- 商品說明		
    `product_image1` 			varchar(200)	not null default'default',		-- 商品圖1
    `product_image2` 			varchar(200)	not null default'default',		-- 商品圖2
    `product_image3` 			varchar(200)	not null default'default',		-- 商品圖3
    `product_situation` 		Boolean			not null default'1',			-- 商品狀態  1上架/0下架
    foreign key (`degree_category`) references degree(`degree_category`) on delete cascade on update cascade
);
alter table product auto_increment = 400001;
desc product;
select * from product;

CREATE TABLE IF NOT EXISTS tour (											-- :::::揪團::::: 
    `tour_no` 				int				primary key auto_increment,		-- 揪團編號
    `tour_hoster` 			int				not null,						-- 揪團主(會員no.)
    `tour_mountain` 		int				not null,						-- 山的編號
    `tour_build` 			datetime		not null default current_timestamp,		-- 建立時間
    `tour_end` 				date			not null,						-- 結束報名日期
    `tour_activitystart` 	date			not null,						-- 活動開始日期
    `tour_activityend` 		date			not null,						-- 活動結束日期
    `tour_min_number` 		int				not null,						-- 最低成團人數
    `tour_max_number` 		int				not null,						-- 最高成團人數
    `tour_progress` 		varchar(30)		not null default'報名中',		-- 揪團狀態 報名中/已截止/已結束/取消/延期
    `tour_apply` 			int				not null default'0',			-- 已報名人數
    `tour_passed` 			int				not null default'0',			-- 已通過審核人數
    `tour_verify` 			int				not null default'0',			-- 未審核人數
    `tour_reject` 			int				not null default'0',			-- 否決審核人數
    `tour_title` 			varchar(100)	not null,						-- 揪團文標題
    `tour_notice` 			varchar(3000)	,						-- 注意事項
    `tour_innertext` 		varchar(9000)	not null,						-- 活動簡介
    `tour_situation` 		boolean			not null default'1',			-- 留言狀態	 	1:上架/0下架
    `tour_equip_1` 			boolean			default'0',						-- 裝備要求1y/0n
    `tour_equip_2` 			boolean			default'0',						-- 裝備要求1y/0n
    `tour_equip_3` 			boolean			default'0',						-- 裝備要求1y/0n
    `tour_equip_4` 			boolean			default'0',						-- 裝備要求1y/0n
    `tour_equip_5` 			boolean			default'0',						-- 裝備要求1y/0n
    `tour_image_1` 			varchar(200)	,								-- 圖片上傳1
    `tour_image_2` 			varchar(200)	,								-- 圖片上傳2
    `tour_image_3` 			varchar(200)	,								-- 圖片上傳3
    `tour_image_4` 			varchar(200)	,								-- 圖片上傳4
    `tour_image_5` 			varchar(200)	,								-- 圖片上傳5
    `tour_image_6` 			varchar(200)	,								-- 圖片上傳6
    foreign key (`tour_hoster`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`tour_mountain`) references mountain(`mountain_no`) on delete cascade on update cascade
    -- ,
-- 	foreign key (`tour_equip_1`) references achievement(`achievement_no`) on delete set null on update set null,
-- 	foreign key (`tour_equip_2`) references achievement(`achievement_no`) on delete set null on update set null,
-- 	foreign key (`tour_equip_3`) references achievement(`achievement_no`) on delete set null on update set null,
-- 	foreign key (`tour_equip_4`) references achievement(`achievement_no`) on delete set null on update set null,
-- 	foreign key (`tour_equip_5`) references achievement(`achievement_no`) on delete set null on update set null
);
alter table tour auto_increment = 100001;
desc tour;
select * from tour;

CREATE TABLE IF NOT EXISTS tour_keep (										-- :::::揪團收藏::::: 
    `tour_keep_mem` 		int			 	not null,						-- "誰"追蹤
    `tour_iskept_tour` 		int				not null,						-- 收藏"哪團"
    foreign key (`tour_keep_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`tour_iskept_tour`) references tour(`tour_no`) on delete cascade on update cascade,
    constraint tour_keep primary key (`tour_keep_mem` , `tour_iskept_tour`)
) ;
desc tour_keep;
select * from tour_keep;

CREATE TABLE IF NOT EXISTS tour_participate (										-- :::::揪團收藏::::: 
    `tour_participate_mem` 			int			 	not null,						-- "誰"追蹤
    `tour_participate_tour` 		int				not null,						-- 收藏"哪團"
    `tour_participate_situation`	varchar(30)		not null default'未審核',		-- 審核狀態 未審核/已審核不通過/已審核通過
    foreign key (`tour_participate_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`tour_participate_tour`) references tour(`tour_no`) on delete cascade on update cascade,
    constraint tour_keep primary key (`tour_participate_mem` , `tour_participate_tour`)
) ;
desc tour_participate;
select * from tour_participate;


CREATE TABLE IF NOT EXISTS tour_report (									-- :::::揪團檢舉::::: 
    `tour_report_no` 		int				primary key auto_increment,		-- 揪團檢舉編號
    `tour_report_mem` 		int				not null,						-- 會員編號
    `tour_report_tour` 		int				not null,						-- 揪團編號
    `tour_report_reason` 	varchar(200)	not null,						-- 檢舉緣由
    `tour_report_situation` varchar(30)		not null default'未處理',		-- 檢舉狀態 未處理/已處理未通過/已處理通過	
    foreign key (`tour_report_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`tour_report_tour`) references tour(`tour_no`) on delete cascade on update cascade
);
alter table tour_report auto_increment = 1001;
desc tour_report;
select * from tour_report;

CREATE TABLE IF NOT EXISTS forum_post (										-- :::::討論::::: 
    `forum_post_no` 		int				primary key auto_increment,		-- 討論文編號
    `forum_post_poster` 	int				not null,						-- 討論文發文者
    `forum_post_category` 	varchar(30)		not null,						-- 討論文類別		新手專區/裝備資訊/揪團心得/登山知識/公告
    `forum_post_image` 		varchar(200)	not null default'default',		-- 討論文圖片
    `forum_post_time` 		datetime		not null default current_timestamp,		-- 發文時間
    `forum_post_title` 		varchar(100)	not null,						-- 討論文標題
    `forum_post_innertext` 	varchar(15000)	not null,						-- 討論文內文
    `forum_post_situation` 	boolean			not null default'1',			-- 討論文狀態	 	1:上架/0下架
    foreign key (`forum_post_poster`) references member(`mem_no`) on delete cascade on update cascade
) ;
alter table forum_post auto_increment = 200001;
desc forum_post;
select * from forum_post;


CREATE TABLE IF NOT EXISTS forum_keep (										-- :::::討論收藏::::: 
    `forum_keep_mem` 		int			 	not null,						-- "誰"收藏
    `forum_iskept_post` 	int				not null,						-- 收藏"哪篇討論文"
    foreign key (`forum_keep_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`forum_iskept_post`) references forum_post(`forum_post_no`) on delete cascade on update cascade,
    constraint tour_keep primary key (`forum_keep_mem` , `forum_iskept_post`)
) ;
desc forum_keep;
select * from forum_keep;

CREATE TABLE IF NOT EXISTS forum_report (									-- :::::討論文檢舉::::: 
    `forum_report_no` 		int				primary key auto_increment,		-- 討論文檢舉編號
    `forum_report_mem` 		int				not null,						-- "誰"檢舉
    `forum_report_post` 	int				not null,						-- 討論文編號
    `forum_report_reason` 	varchar(200)	not null,						-- 檢舉緣由
    `forum_report_situation`varchar(30)		not null default'未處理',		-- 檢舉狀態 未處理/已處理未通過/已處理通過	
    foreign key (`forum_report_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`forum_report_post`) references forum_post(`forum_post_no`) on delete cascade on update cascade
); 
alter table forum_report auto_increment = 2001;
desc forum_report;
select * from forum_report;

CREATE TABLE IF NOT EXISTS comment_post (									-- :::::留言::::: 
    `comment_no` 			int				primary key auto_increment,		-- 留言編號
    `comment_poster` 		int				not null,						-- 留言者
    `comment_class`			varchar(20)		not null,						-- 討論區 ? 揪團
    `forum_post_no` 		int				default null,					-- 討論文編號		
    `tour_post_no` 			int				default null,					-- 揪團編號		
    `comment_time` 			datetime		not null default current_timestamp,				-- 留言時間
    `comment_innertext` 	varchar(600)	not null,						-- 留言內文
    `comment_situation` 	boolean			not null default'1',			-- 留言狀態	 	1:上架/0下架
    foreign key (`comment_poster`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`forum_post_no`) references forum_post(`forum_post_no`) on delete cascade on update cascade,
    foreign key (`tour_post_no`) references tour(`tour_no`) on delete cascade on update cascade
) ;
alter table comment_post auto_increment = 300001;
desc comment_post;
select * from comment_post;

CREATE TABLE IF NOT EXISTS comment_report (										-- :::::留言檢舉::::: 
    `comment_report_no` 		int				primary key auto_increment,		-- 留言檢舉編號
    `comment_report_mem` 		int				not null,						-- “誰"檢舉
    `comment_report_comment` 	int				not null,						-- 檢舉"哪篇留言"
    `comment_report_reason` 	varchar(200)	not null,						-- 檢舉緣由
    `comment_report_sitution`	varchar(30)		not null default'未處理',		-- 檢舉狀態 未處理/已處理未通過/已處理通過	
    foreign key (`comment_report_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`comment_report_comment`) references comment_post(`comment_no`) on delete cascade on update cascade
);
alter table comment_report auto_increment = 3001;
desc comment_report;
select * from comment_report;

CREATE TABLE IF NOT EXISTS orders (												-- :::::訂單::::: 
    `order_no` 					int				primary key auto_increment,		-- 訂單編號
    `member_no` 				int				not null,						-- 會員編號
    `order_total` 				int				not null,						-- 原始總價
    `order_logistics_fee` 		int				not null,						-- 運費		
    `order_discount` 			int				not null default'1',			-- 折數
    `order_build` 				datetime		not null default current_timestamp,		-- 建立時間
    `order_position` 			Int				not null default'1',			-- 訂單狀態 1訂單確認中/2待出貨/3已出貨/4待取貨/5已取貨		
    `order_logistics_deliver` 	varchar(30)		not null,						-- 運送方式 快遞宅配(60)/郵寄宅配(100) 滿5000免運
    `order_logistics_recipient` varchar(30)		not null,						-- 收件人
	`order_logistics_phone` 	varchar(200)	not null,						-- 收件人電話
    `order_logistics_address` 	varchar(200)	not null,						-- 收件地址
    `order_logistics_progress` 	int				not null default'0',			-- 出貨進度 1待確認/2已出貨/3運送中/4已送達
    `order_cashflow` 			varchar(30)		not null default'點數付款',		-- 付款方式 貨到付款/線上刷卡/點數付款
    `order_paytime` 			datetime		not null default current_timestamp		-- 付款時間
);
alter table orders auto_increment = 500001; 
desc orders;
select * from orders;

CREATE TABLE IF NOT EXISTS order_list (										-- :::::詳細訂單::::: 
    `order_no` 				int			 	not null,						-- 訂單編號
    `product_no` 			int				not null,						-- 商品編號
    `product_number` 		int			 	not null,						-- 商品個數
    `product_price` 		int				not null,						-- 商品單價 跟產品售價不一樣哦，這是購物當下的價格		
    foreign key (`order_no`) references orders(`order_no`) on delete cascade on update cascade,
    foreign key (`product_no`) references product(`product_no`) on delete cascade on update cascade,
    constraint order_list primary key (`order_no` , `product_no`)
) ;
desc order_list;
select * from order_list;

CREATE TABLE IF NOT EXISTS product_keep (									-- :::::商品收藏::::: 
    `product_keep_mem` 		int			 	not null,						-- "誰"收藏
    `product_iskept_no` 	int				not null,						-- 收藏"哪個商品"
    foreign key (`product_keep_mem`) references member(`mem_no`) on delete cascade on update cascade,
    foreign key (`product_iskept_no`) references product(`product_no`) on delete cascade on update cascade,
    constraint product_keep primary key (`product_keep_mem` , `product_iskept_no`)
) ;
desc product_keep;
select * from product_keep;


