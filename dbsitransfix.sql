Create table Pengguna (username varchar(25) primary key,
					   nama varchar(50), 
					   password varchar(200),
					   role varchar(25));
				   
Create table Customer (IdCustomer INT Primary Key,
					   namaCustomer varchar(50),
					   TelponCustomer varchar(50),
					   AlamatCustomer varchar(50)
					   );
					   
CREATE TABLE SUPPLIER (
					 IdSupplier INT Primary Key,
					 NamaSupplier VARCHAR(50),
					 TelponSupplier VARCHAR(50),
					 AlamatSupplier VARCHAR(100),
					 No_Rekening VARCHAR(50)
					);

Create table Merk (IdMerk INT unique,
				   IdSupplier INT, 
				   NamaSupplier varchar(50),
				   status varchar (25),
				   PRIMARY KEY (IdMerk, IdSupplier),
				   FOREIGN KEY (IdSupplier) REFERENCES SUPPLIER (IdSupplier));

CREATE TABLE JENIS (
					 IdJenis INT,
					 NamaJenis VARCHAR(50),
					 ROP INT,
					 Stok_kilo NUMERIC,
					 Stok_Karton NUMERIC,
					 PRIMARY KEY (IdJenis)
);

Create table PRODUK (IdMerk INT,
					 IdJenis INT,
					 Lokasi varchar(25),
					 namaProduk varchar(50),
					 harga_beli INT,
					 harga_jual INT,
					 kilo NUMERIC,
					 karton NUMERIC,
					 PRIMARY KEY (IdMerk, IdJenis, Lokasi),
					 FOREIGN KEY (IdMerk) REFERENCES MERK (IdMerk) ON UPDATE CASCADE ON DELETE CASCADE,
					 FOREIGN KEY (IdJenis) REFERENCES JENIS (IdJenis) ON UPDATE CASCADE ON DELETE CASCADE
					 );

CREATE TABLE PEMBAYARAN_IN (
							 IdBayar INT, 
							 Customer VARCHAR(50),
							 Tgl_Trans DATE,
							 Tgl_Bayar DATE,
							 JumlahBayar NUMERIC,
							 Status_Bayar VARCHAR(25),
							 PRIMARY KEY (IdBayar)
);

CREATE TABLE PEMBAYARAN_OUT (
							 IdBayar INT,
							 Supplier VARCHAR(50),
							 Tgl_Trans DATE,
							 Tgl_Bayar DATE,
							 JumlahBayar NUMERIC,
							 Status_Bayar VARCHAR(25),
							 PRIMARY KEY (IdBayar)
);					 
					 
Create table Penjualan(IdJual INT primary key,
					   IdBayar INT,
					   Customer VARCHAR(50),
					   Produk varchar(50),
					   tgl_jual DATE,
					   tgl_kirim DATE,
					   jatuh_tempo DATE,
					   cara_kirim varchar(25),
					   cara_bayar varchar(25),
					   status_del varchar(25),
					   harga_total NUMERIC,
					   karton NUMERIC,
					   kilo NUMERIC,
					   lokasi varchar(50),					   
					   FOREIGN KEY (IdBayar) REFERENCES PEMBAYARAN_IN (IdBayar) ON DELETE CASCADE ON UPDATE CASCADE
					   );

CREATE TABLE PEMBELIAN (
						 IdBeli INT,
						 IdBayar INT,
						 Supplier VARCHAR(50),
						 Produk VARCHAR(50),
						 Tgl_Beli DATE,
						 Tgl_Terima DATE,
						 Cara_Terima VARCHAR(25),
						 Cara_Bayar VARCHAR(25),
						 Status_Del VARCHAR(25),
						 Harga_Total NUMERIC,
						 Karton NUMERIC,
						 Kilo NUMERIC,
						 lokasi varchar(50),
						 PRIMARY KEY (IdBeli),
						 FOREIGN KEY (IdBayar) REFERENCES PEMBAYARAN_OUT(IdBayar) ON DELETE CASCADE ON UPDATE CASCADE
						
); 


insert into pengguna values ('sm02',	'Akram Amrullah',	'$2y$13$BnSe17SNoHRugDiGhxKnveE0xlq3EkKwhynN8f.bS26r3WjjkYxBy',	'sales marketing'),
							('purchasing02','Winny Claudia','$2y$13$dsc1G5m4HFvbmCvVNsi8k.Vy60cVXJC8zJ818cqp1xVArc/EinLz6',	'purchasing'),
							('inventori02' ,	'Fauziah Raihani' ,	'$2y$13$RQhWF87EI8ap6crqwmkY8e3eEEF8q.GC6sowEKfysfmHygAFsZzEC'	, 'admin inventori'),
							('finance02',	'Binti Nur' ,	'$2y$13$/tq4SNCJ4EaZtlKhpSTpWe6vQ8TT4OModYpCIO7smhkR7UWvKYAzu' ,'finance'),
							('bod02'	 ,'Andre Valerian'	,'$2y$13$CsB3NcihjSKI4lK6U.h3C./Xnq8GBOJc/7Rd02bkzwikuiyUYzF4u' ,	'bod'),
							('admin', 'Sularjo' ,	'$2y$13$ixnSqCNnCoFuoX8s4i3PIest.bX9HNINNTi8RZ2wqcnXWCjgo1OQa' ,	'admin'),
							('deactive', 'Deactive User', '$2y$13$CsB3NcihjSKI4lK6U.h3C./Xnq8GBOJc/7Rd02bkzwikuiyUYzF4u', 'deactivated');

 
insert into customer values
 ('1000000001', 'Lotte Mart', '021123456', 'Jl. Rajawali  02, Jakarta Timur'), 
 ('1000000002', 'Hotel Santika', '021123457', 'Perum Gandasari 05, Jakarta Selatan'),
 ('1000000003', 'Hotel Bumiwiyata', '021123458', 'Mares Margonda, Depok'),  
 ('1000000004', 'Resto McDonald', '021123459', 'Pondok Pepaya Asri, Depok'), 
 ('1000000005', 'Resto KFC', '021123451', 'Jl. Jatiasih, Bekasi'),
 ('1000000006', 'Resto AW', '021123452', 'Pondok Cabe, Tangerang Selatan'), 
 ('1000000007', 'Modena Resto', '021123453', 'Jl. Kenanga Raya, Bekasi'),
 ('1000000008', 'Delicia Hotel', '021123454', 'Jl. Arjuna No. 20, Jakarta Utara'),  
 ('1000000009', 'Burger King', '021123455', 'Jl. Bulog Rante, Jakarta Timur'), 
 ('1000000010', 'Hollycow', '021123450', 'Jl. Kapten P. Tendean, Jakarta Pusat '); 

insert into supplier values
 ('2000000001', 'PT. Indoguna', '021123456', 'Jl. Kapten P. Tendean, Jakarta Pusat', '0987654321'), 
 ('2000000002', 'PT. Bina Mentari Tunggal', '031123457', 'Pondok Cabe, Tangerang Selatan', '12654378965'),
 ('2000000003', 'PT. Agro Giri Perkasa', '021123458', 'Mares Margonda, Depok', '9876543287'),  
 ('2000000004', 'Tanjung Unggul Mandiri', '0231123459', 'Perum Gandasari 05, Jakarta Selatan', '5643789231'), 
 ('2000000005', 'PT. Andini Karya Makmur', '031123451', 'Perum Asri Sari 06, Jakarta Barat','432675489'),
 ('2000000006', 'Agri Satwa Kencana', '021123452', 'Jl. Rajawali  02, Jakarta Timur', '7689543023'), 
 ('2000000007', 'PT. Pasir Tengah', '021123453', 'Jl. Kenanga Raya, Bekasi', '2314567896'),
 ('2000000008', 'Widodo Makmur', '021123454', 'Jl. Bulog Rante, Jakarta Timur','9867342512'),  
 ('2000000009', 'PT. Lembu Perkasa', '021123455', 'Pondok Pepaya Asri, Depok', '342156890'), 
 ('2000000010', 'Jaya Sentosa', '021123450', 'Jl. Jatiasih, Bekasi','1223344567');  
 
insert into merk values
 ('300000001', '2000000001' , 'Affco', 'aktif'),
 ('300000002', '2000000010' , 'Moonbeef', 'aktif'),
 ('300000003', '2000000002' , 'Teys', 'aktif'),
 ('300000004', '2000000003' , 'G.Lea', 'aktif'),
 ('300000005', '2000000004' , 'Riverland', 'aktif'),
 ('300000006', '2000000005' , 'Raplh', 'aktif'),
 ('300000007', '2000000006' , 'Alliance', 'aktif'),
 ('300000008', '2000000007' , 'Hantervaley', 'aktif'),
 ('300000009', '2000000008' , 'Harvey', 'aktif'),
 ('300000010', '2000000009' , 'Hill Top', 'aktif');

insert into jenis values 
 ('400000001', 'Sirloin', 150 , 1300 , 70), 
 ('400000002', 'Hati', 0 , 0 , 0),
 ('400000003', 'Knuckle', 100 ,1000 , 70),
 ('400000004', 'Striploin', 60 , 700 , 46),
 ('400000005', 'Cubroll', 90 , 1400 , 90),
 ('400000006', 'Chuck', 130 , 900 , 60),
 ('400000007', 'Shank', 200 , 1800 , 100),
 ('400000008', 'Oxtail', 130 , 600 , 36),
 ('400000009', 'Rib eye', 80 , 900 , 50),
 ('400000010', 'Shorttrib', 150 , 1200 ,70);

insert into produk values 
 ('300000001',  '400000001', 'Cakung', 'Sirloin Affco', 120000, 135000, 100, 5),
 ('300000001',  '400000001', 'Bekasi', 'Sirloin Affco', 120000, 135000, 100, 5),
 ('300000002',  '400000001', 'Cakung', 'Sirloin Moonbeef', 110000, 130000, 200, 10),
 ('300000002',  '400000001', 'Bekasi', 'Sirloin Moonbeef', 110000, 130000, 200, 10),
 ('300000003',  '400000004', 'Cakung', 'Striploin Teys', 115000, 125000, 150, 8),
 ('300000003',  '400000004', 'Bekasi', 'Striploin Teys', 115000, 125000, 150, 8),
 ('300000004',  '400000003', 'Cakung','Knuckle G.Lea', 150000, 160000, 200, 10),
 ('300000004',  '400000003', 'Bekasi','Knuckle G.Lea', 150000, 160000, 200, 10),
 ('300000005',  '400000005', 'Cakung', 'Cubroll Riverland', 95000, 115000, 300, 15),
 ('300000005',  '400000005', 'Bekasi', 'Cubroll Riverland', 95000, 115000, 300, 15),
 ('300000006',  '400000006', 'Cakung', 'Chuck Raplh', 130000, 145000, 200, 10),
 ('300000006',  '400000006', 'Bekasi', 'Chuck Raplh', 130000, 145000, 200, 10),
 ('300000007',  '400000007', 'Cakung', 'Shank Alliance', 200000, 220000, 300, 15),
 ('300000007',  '400000007', 'Bekasi', 'Shank Alliance', 200000, 220000, 300, 15),
 ('300000008',  '400000008', 'Bekasi', 'Oxtail Hantervaley', 90000, 105000, 200, 10),
 ('300000008',  '400000008', 'Cakung', 'Oxtail Hantervaley', 90000, 105000, 200, 10),
 ('300000009',  '400000009', 'Bekasi', 'Rib eye Harvey', 150000, 165000, 250, 10), 
 ('300000009',  '400000009', 'Cakung', 'Rib eye Harvey', 150000, 165000, 250, 10),
 ('300000010',  '400000010', 'Bekasi','Shorttrib Hill Top', 145000, 165000, 300, 20),
 ('300000010',  '400000010', 'Cakung','Shorttrib Hill Top', 145000, 165000, 300, 20),
 ('300000001',  '400000004', 'Bekasi', 'Striploin Affco', 180000, 200000, 200, 15),
 ('300000001',  '400000004', 'Cakung', 'Striploin Affco', 180000, 200000, 200, 15),
 ('300000003',  '400000001', 'Bekasi', 'Sirloin Teys', 100000, 120000, 350, 20),
 ('300000003',  '400000001', 'Cakung', 'Sirloin Teys', 100000, 120000, 350, 20),
 ('300000003',  '400000007', 'Bekasi', 'Shank Teys', 160000, 175000, 300, 20),
 ('300000003',  '400000007', 'Cakung', 'Shank Teys', 160000, 175000, 300, 20),
 ('300000005',  '400000003', 'Bekasi','Knuckle Riverland', 120000, 140000, 300, 25),
 ('300000005',  '400000003', 'Cakung','Knuckle Riverland', 120000, 140000, 300, 25),
 ('300000008',  '400000005', 'Bekasi', 'Cubroll Hantervaley', 200000, 230000, 400, 30),
 ('300000008',  '400000005', 'Cakung', 'Cubroll Hantervaley', 200000, 230000, 400, 30),
 ('300000007',  '400000006', 'Cakung', 'Chuck Alliance', 135000, 150000, 250, 20),
 ('300000007',  '400000006', 'Bekasi', 'Chuck Alliance', 135000, 150000, 250, 20),
 ('300000008',  '400000007', 'Cakung', 'Shank Hantervaley', 120000, 145000, 300, 15),
 ('300000008',  '400000007', 'Bekasi', 'Shank Hantervaley', 120000, 145000, 300, 15),
 ('300000004',  '400000008', 'Bekasi', 'Oxtail G.Lea', 100000, 115000, 100, 8),
 ('300000004',  '400000008', 'Cakung', 'Oxtail G.Lea', 100000, 115000, 100, 8),
 ('300000010',  '400000009', 'Bekasi','Rib eye Hill Top', 140000, 155000, 200, 15),
 ('300000010',  '400000009', 'Cakung','Rib eye Hill Top', 140000, 155000, 200, 15),
 ('300000002',  '400000010', 'Bekasi','Shorttrib Moonbeef', 95000, 105000, 300, 15),
 ('300000002',  '400000010', 'Cakung','Shorttrib Moonbeef', 95000, 105000, 300, 15);
 
insert into pembayaran_out values 
(200000001, 'PT. Indoguna', '2016-01-20', '2016-01-21', 500000000, 'Lunas');
insert into pembayaran_out values 
(200000002, 'PT. Bina Mentari Tunggal', '2016-01-20', '2016-01-21', 250000000, 'Lunas');
insert into pembayaran_out values 
(200000003, 'PT. Indoguna', '2016-02-20', '2016-02-21', 500000000, 'Lunas');
insert into pembayaran_out values 
(200000004, 'PT. Bina Mentari Tunggal', '2016-02-20', '2016-02-21', 400000000, 'Lunas');
insert into pembayaran_out values 
(200000005, 'PT. Indoguna', '2016-03-20', '2016-03-21', 50000000, 'Lunas');
insert into pembayaran_out values 
(200000006, 'PT. Bina Mentari Tunggal', '2016-03-20', '2016-03-21', 400000000, 'Lunas');
insert into pembayaran_out values 
(200000007, 'PT. Indoguna', '2016-04-20', '2016-04-21', 200000000, 'Lunas');
insert into pembayaran_out values 
(200000008, 'PT. Bina Mentari Tunggal', '2016-04-20', '2016-04-21', 350000000, 'Lunas');
insert into pembayaran_out values 
(200000009, 'PT. Indoguna', '2016-05-02', '2016-05-06', 500000000, 'Lunas');
insert into pembayaran_out values 
(200000010, 'PT. Bina Mentari Tunggal', '2016-05-03', '2016-05-07', 300000000, 'Lunas');
insert into pembayaran_out values (200000011, 'PT. Indoguna', '2015-12-02', '2015-12-10', 500000000, 'Lunas');
insert into pembayaran_out values (200000012, 'PT. Indoguna', '2015-12-06', '2015-12-10', 550000000, 'Lunas');
insert into pembayaran_out values 
(200000018,	'Widodo Makmur',	'2016-05-12', null,	7500000,	'Hutang'),
(200000014,	'PT. Bina Mentari Tunggal',	'2016-05-12', null,	4800000,	'Hutang'),
(200000017,	'PT. Agro Giri Perkasa',	'2016-05-12', null,	8000000, 'Hutang'),
(200000015,	'PT. Andini Karya Makmur',	'2016-05-12', null,	6000000,	'Hutang'),
(200000019,	'Agri Satwa Kencana',	'2016-05-12', null, 4500000,	'Hutang'),
(200000013,	'PT. Indoguna',	'2016-05-12',	null,	20900000,	'Hutang'),
(200000016,	'Jaya Sentosa',	'2016-05-12',	null,	13000000,	'Hutang');
insert into pembayaran_out values 
(200000030,	'Agri Satwa Kencana'	, '2016-04-14',	'2016-04-15',	120000000,	'Lunas'),
(200000025,	'PT. Agro Giri Perkasa'	, '2016-04-14'	, '2016-04-15',	16800000,	'Lunas'),
(200000027,	'PT. Bina Mentari Tunggal'	, '2016-03-14'	, '2016-03-15',	17220000	, 'Lunas'),
(200000029,	'PT. Andini Karya Makmur'	, '2016-03-14'	, '2016-03-15',	21000000	, 'Lunas'),
(200000023,	'Tanjung Unggul Mandiri'	, '2016-02-14'	, '2016-02-15',	10800000	, 'Lunas'),
(200000026,	'Widodo Makmur'	, '2016-02-14'	, '2016-02-15',	3220000	, 'Lunas'),
(200000024,	'PT. Indoguna'	, '2016-01-14'	, '2016-01-15',	18000000	, 'Lunas'),
(200000028,	'PT. Pasir Tengah'	, '2016-01-14',	'2016-01-15',	13800000	, 'Lunas');

insert into pembayaran_in values (200000001, 'Modena Resto', '2016-01-23', '2016-01-26', 500000000, 'Lunas');
insert into pembayaran_in values (200000002, 'Burger King', '2016-01-23', '2016-01-26', 400000000, 'Lunas');
insert into pembayaran_in values (200000003, 'Modena Resto', '2016-02-23', '2016-02-26', 600000000, 'Lunas');
insert into pembayaran_in values (200000004, 'Burger King', '2016-02-23', '2016-02-26', 400000000, 'Lunas');
insert into pembayaran_in values (200000005, 'Modena Resto', '2016-03-23', '2016-03-26', 50000000, 'Lunas');
insert into pembayaran_in values (200000006, 'Burger King', '2016-03-23', '2016-03-26', 700000000, 'Lunas');
insert into pembayaran_in values (200000007, 'Modena Resto', '2016-04-23', '2016-04-26', 450000000, 'Lunas');
insert into pembayaran_in values (200000008, 'Burger King', '2016-04-23', '2016-04-26', 400000000, 'Lunas');
insert into pembayaran_in values (200000009, 'Modena Resto', '2016-05-02', '2016-05-10', 400000000, 'Lunas');
insert into pembayaran_in values (200000010, 'Burger King', '2016-05-06', '2016-05-10', 550000000, 'Lunas');
insert into pembayaran_in values (200000011, 'Modena Resto', '2015-12-02', '2015-12-10', 400000000, 'Lunas');
insert into pembayaran_in values (200000012, 'Burger King', '2015-12-06', '2015-12-10', 550000000, 'Lunas');
insert into pembayaran_in values 
(200000020,	'Hotel Bumiwiyata','2016-05-12',	null,	9900000,	'Piutang'),
(200000014,	'Burger King', '2016-05-12', null,	11250000,	'Piutang'),
(200000017,	'Resto AW',	  '2016-05-12'	, null	,6250000,	'Piutang'),
(200000015,	'Lotte Mart', '2016-05-12',	null,	30300000,	'Piutang'),
(200000019,	'Resto KFC', '2016-05-12',	null,	15500000,	'Piutang'),
(200000016,	'Hollycow',	'2016-05-12',	null, 13000000,	'Piutang'),
(200000013,	'Hotel Santika',	'2016-05-12',	null, 6750000,	'Piutang'),
(200000018,	'Resto McDonald',	'2016-05-12', null,	28300000,	'Piutang');

insert into pembayaran_in values
(200000028,	'Modena Resto'	, '2016-04-14'	, '2016-04-19',	138250000	, 'Lunas'),
(200000023,	'Hollycow'	, '2016-04-14'	, '2016-04-15',	163650000	, 'Lunas'),
(200000029,	'Resto AW'	, '2016-03-14'	, '2016-03-15',	175950000	, 'Lunas'),
(200000025,	'Lotte Mart'	, '2016-03-14'	, '2016-03-15',	3500000	, 'Lunas'),
(200000027,	'Hotel Bumiwiyata'	, '2016-02-14'	, '2016-02-15',	40800000	, 'Lunas'),
(200000026,	'Burger King'	, '2016-02-14'	, '2016-02-15',	156375000	, 'Lunas'),
(200000024,	'Hotel Santika'	, '2016-01-14'	, '2016-01-15',	47400000	, 'Lunas');

insert into pembelian values
(100000001,	200000013,	'PT. Indoguna',	'Sirloin Affco',	'2016-05-12',	'2016-05-13',	'Diantar',	'Transfer',	'Belum Diterima',	4800000,	4,	40,	'Bekasi'),
(100000002,	200000013,	'PT. Indoguna',	'Striploin Teys',	'2016-05-12',	'2016-05-14',	'Diantar',	'Cash',	'Belum Diterima',	4600000,	10,	40,	'Bekasi'),
(100000003,	200000015,	'PT. Andini Karya Makmur',	'Sirloin Affco',	'2016-05-12',	'2016-05-13',	'Diantar',	'Cash',	'Belum Diterima',	6000000,	4,	50,	'Cakung'),
(100000004,	200000016,	'Jaya Sentosa',	'Chuck Raplh',	'2016-05-12',	'2016-05-14',	'Diantar',	'Transfer',	'Belum Diterima',	13000000,	10,	100,	'Bekasi'),
(100000005,	200000017,	'PT. Agro Giri Perkasa',	'Shank Teys',	'2016-05-12',	'2016-05-14',	'Diantar',	'Cash',	'Belum Diterima',	8000000,	10,	50,	'Cakung'),
(100000006,	200000018,	'Widodo Makmur',	'Rib eye Harvey',	'2016-05-12',	'2016-05-16',	'Dijemput',	'Transfer',	'Belum Diterima',	7500000,	10,	50,	'Cakung'),
(100000007,	200000013,	'PT. Indoguna',	'Sirloin Affco',	'2016-05-12',	'2016-05-13',	'Diantar',	'Cash',	'Belum Diterima',	6000000,	5,	50,	'Bekasi'),
(100000008,	200000014,	'PT. Bina Mentari Tunggal',	'Sirloin Affco',	'2016-05-12',	'2016-05-13',	'Diantar',	'Cash',	'Belum Diterima',	4800000,	4,	40,	'Bekasi'),
(100000009,	200000013,	'PT. Indoguna',	'Sirloin Moonbeef',	'2016-05-12',	'2016-05-13',	'Diantar',	'Cash',	'Belum Diterima',	5500000,	10,	50,	'Bekasi'),
(100000010,	200000019,	'Agri Satwa Kencana',	'Oxtail Hantervaley',	'2016-05-12',	'2016-05-14',	'Diantar',	'Transfer',	'Belum Diterima',	4500000,	5,	50,	'Cakung');

insert into pembelian values
(100000011,	200000024,	 'PT. Indoguna',	'Rib eye Harvey',	'2016-01-14',	'2016-01-18'	, 'Dijemput' ,	'Cash',	'Diterima' , 	18000000,	60,	120,	'Bekasi'),
(100000012,	200000026,	'Widodo Makmur',	'Chuck Alliance',	'2016-02-14',	'2016-02-25'	, 'Dijemput' ,	'Cash',	'Diterima' , 	3220000,	5,	23,	'Cakung'),
(100000013,	200000030,	 'Agri Satwa Kencana',	'Knuckle Hantervalley',	'2016-04-14',	'2016-04-24',	'Diantar',	'Cash',	'Diterima' , 	120000000,	123,	750,	'Bekasi'),
(100000014,	200000027,	 'PT. Bina Mentari Tunggal',	'Chuck Alliance',	'2016-03-14',	'2016-03-24'	, 'Dijemput' ,	'Cash',	'Diterima' , 	17220000,	15,	123,	'Cakung'),
(100000015,	200000028,	 'PT. Pasir Tengah',	'Striploin Teys',	'2016-01-14',	'2016-01-19',	'Diantar',	'Cash',	'Diterima' , 	13800000,	15,	120,	'Bekasi'),
(100000016,	200000023,	 'Tanjung Unggul Mandiri',	'Oxtail Hantervaley',	'2016-02-14',	'2016-02-18'	, 'Dijemput' ,	'Cash',	'Diterima' , 	10800000,	12,	120,	'Bekasi'),
(100000017,	200000029,	 'PT. Andini Karya Makmur',	'Rib eye Hill Top',	'2016-03-14',	'2016-03-18',	'Diantar',	'Transfer',	'Diterima' , 	21000000,	34,	150,	'Cakung'),
(100000018,	200000025,	 'PT. Agro Giri Perkasa',	'Rib eye Hill Top',	'2016-04-14',	'2016-04-18',	'Diantar',	'Cash',	'Diterima' , 	16800000,	45,	120,	'Cakung');

insert into penjualan values
(100000001, 200000015,	'Lotte Mart',	'Cubroll Riverland',	'2016-05-12',	'2016-05-13',	'2016-05-14',	'Delivery',	'Cash',	'Belum Dikirim',	4600000,	10,	40,	'Bekasi'),
(100000002,	200000015,	'Lotte Mart',	'Sirloin Moonbeef',	'2016-05-12',	'2016-05-13',	'2016-05-14',	'Delivery',	'Cash',	'Belum Dikirim',	6500000,	10,	50,	'Bekasi'),
(100000003,	200000015,	'Lotte Mart',	'Knuckle G.Lea',	'2016-05-12',	'2016-05-14',	'2016-05-15',	'Delivery',	'Cash',	'Belum Dikirim',	9600000,	12,	60,	'Cakung'),
(100000004,	200000016,	'Hollycow',	'Sirloin Moonbeef',	'2016-05-12',	'2016-05-14',	'2016-05-21',	'Delivery',	'Transfer',	'Belum Dikirim',	13000000,	15,	100,	'Bekasi'),
(100000005,	200000017,	'Resto AW',	'Striploin Teys',	'2016-05-12',	'2016-05-14',	'2016-05-15',	'Delivery',	'Cash',	'Belum Dikirim',	6250000,	10,	50,	'Bekasi'),
(100000006,	200000020,	'Hotel Bumiwiyata',	'Rib eye Harvey',	'2016-05-12',	'2016-05-24',	'2016-05-31',	'Delivery',	'Transfer',	'Belum Dikirim',	9900000,	6,	60,	'Cakung'),
(100000007,	200000013,	'Hotel Santika',	'Sirloin Affco',	'2016-05-12',	'2016-05-13',	'2016-05-14',	'Delivery',	'Cash',	'Dikirim',	6750000,	4,	50,	'Bekasi'),
(100000008,	200000014,	'Burger King',	'Sirloin Affco',	'2016-05-12',	'2016-05-14',	'2016-05-14',	'PickUp',	'Transfer',	'Dikirim',	4050000,	3,	30,	'Bekasi'),
(100000009,	200000018,	'Resto McDonald',	'Shank Alliance',	'2016-05-12',	'2016-05-14',	'2016-05-14',	'Delivery',	'Cash',	'Belum Dikirim',	22000000,	10,	100,	'Bekasi'),
(100000010,	200000018,	'Resto McDonald',	'Oxtail Hantervaley',	'2016-05-12',	'2016-05-14',	'2016-05-16',	'Delivery',	'Transfer',	'Belum Dikirim',	6300000,	6,	60,	'Cakung'),
(100000011,	200000019,	'Resto KFC',	'Chuck Raplh',	'2016-05-12',	'2016-05-16',	'2016-05-21',	'Delivery',	'Transfer',	'Belum Dikirim',	7250000,	5,	50,	'Cakung'),
(100000012,	200000019,	'Resto KFC',	'Shorttrib Hill Top',	'2016-05-12',	'2016-05-14',	'2016-05-21',	'Delivery',	'Transfer',	'Belum Dikirim',	8250000,	5,	50,	'Bekasi'),
(100000013,	200000014,	'Burger King',	'Sirloin Teys',	'2016-05-12',	'2016-05-17',	'2016-05-14',	'Delivery',	'Transfer',	'Belum Dikirim',	7200000,	6,	60,	'Bekasi'),
(100000014,	200000015,	'Lotte Mart',	'Knuckle G.Lea',	'2016-05-12',	'2016-05-13',	'2016-05-13',	'Delivery',	'Cash',	'Belum Dikirim',	9600000,	10,	60,	'Bekasi');

insert into penjualan values
(100000016,	200000026,	'Burger King'	,'Knuckle G.Lea'	, '2016-02-14' 	, '2016-02-18'	, '2016-02-17'	, 'PickUp',	'Cash', 	'Dikirim',	96000000,	300,	600	, 'Cakung'),
(100000017,	200000026,	'Burger King'	,'Shank Teys'	, '2016-02-14' 	, '2016-02-18'	, '2016-02-27'	, 'PickUp',	'Transfer', 	'Dikirim',	60375000,	130,	345	, 'Cakung'),
(100000018,	200000028,	'Modena Resto'	,'Sirloin Moonbeef'	, '2016-04-14' 	, '2016-04-17'	, '2016-04-17'	, 'PickUp',	'Cash', 	'Dikirim',	44200000,	120,	340	, 'Bekasi'),
(100000019,	200000023,	'Hollycow'	,'Shank Alliance'	, '2016-04-14' 	, '2016-04-15'	, '2016-04-23'	, 'Delivery', 	'Transfer', 	'Dikirim',	6600000,	12,	30	, 'Bekasi'),
(100000020,	200000023,	'Hollycow'	,'Cubroll Riverland'	, '2016-04-14' 	, '2016-04-15'	, '2016-04-16'	, 'Delivery', 	'Transfer', 	'Dikirim',	6250000,	25,	50	, 'Cakung'),
(100000021,	200000027,	'Hotel Bumiwiyata'	,'Sirloin Teys'	, '2016-02-14' 	, '2016-02-19'	, '2016-02-20'	, 'Delivery', 	'Transfer', 	'Dikirim',	40800000,	120,	340	, 'Cakung'),
(100000022,	200000029,	'Resto AW'	,'Cubroll Hantervaley'	, '2016-03-14' 	, '2016-03-28'	, '2016-03-26'	, 'PickUp',	'Cash', 	'Dikirim',	175950000,	59,	765	, 'Bekasi'),
(100000023,	200000024,	'Hotel Santika'	,'Sirloin Teys'	, '2016-01-14' 	, '2016-01-22'	, '2016-01-22'	, 'Delivery', 	'Cash', 	'Dikirim',	5400000,	20,	45	, 'Bekasi'),
(100000024,	200000028,	'Modena Resto'	,'Rib eye Harvey'	, '2016-04-14' 	, '2016-04-21'	, '2016-04-16'	, 'Delivery', 	'Transfer', 	'Dikirim',	94050000,	340,	570	, 'Cakung'),
(100000025,	200000023,	'Hollycow'	,'Knuckle G.Lea'	, '2016-04-14' 	, '2016-04-23'	, '2016-04-16'	, 'Delivery', 	'Transfer', 	'Dikirim',	108800000,	340,	680	, 'Cakung'),
(100000026,	200000024,	'Hollycow'	,'Oxtail Hantervaley'	, '2016-01-14' 	, '2016-01-17'	, '2016-01-16'	, 'PickUp',	'Cash', 	'Dikirim',	42000000,	123,	400	, 'Bekasi'),
(100000027,	200000025,	'Lotte Mart'	,'Shank Teys'	, '2016-03-14' 	, '2016-03-17'	, '2016-03-15'	, 'Delivery', 	'Transfer', 	'Dikirim',	3500000,	10,	20,	 'Bekasi');

 create table role (
					id int primary key,
					role varchar(25));
 insert into role values
						(1, 'sales marketing'),
						(2, 'purchasing'),
						(3, 'admin inventori'),
						(4, 'bod'),
						(5, 'admin'),
						(6, 'finance'),
						(7, 'deactivated');

create table caraterima (
					id int primary key,
					caraterima varchar(25));

insert into caraterima values (1, 'Diantar'),
			       (2, 'Dijemput');

create table carabayar (
					id int primary key,
					caraterima varchar(25) );

insert into carabayar values (1,  'Cash'),
			      ( 2, 'Transfer');

create table carakirim (
					id int primary key,
					carakirim varchar(25) );

insert into carakirim values (1,  'Delivery'),
							 (2, 'PickUp' );
create table lokasi (id int primary key,
					lokasi varchar(50));
insert into lokasi values (1, 'Bekasi'),
						(2, 'Cakung') ;

						


