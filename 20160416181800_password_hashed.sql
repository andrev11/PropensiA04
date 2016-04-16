--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.2
-- Dumped by pg_dump version 9.5.2

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: customer; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE customer (
    idcustomer integer NOT NULL,
    namacustomer character varying(50),
    telponcustomer character varying(50),
    alamatcustomer character varying(50)
);


ALTER TABLE customer OWNER TO postgres;

--
-- Name: jenis; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE jenis (
    idjenis integer NOT NULL,
    namajenis character varying(50),
    rop integer,
    stok_kilo numeric,
    stok_karton numeric
);


ALTER TABLE jenis OWNER TO postgres;

--
-- Name: merk; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE merk (
    idmerk integer NOT NULL,
    idsupplier integer NOT NULL,
    namasupplier character varying(50),
    status character varying(25)
);


ALTER TABLE merk OWNER TO postgres;

--
-- Name: pembayaran_in; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pembayaran_in (
    idbayar integer NOT NULL,
    customer character varying(50),
    tgl_trans date,
    tgl_bayar date,
    jumlahbayar numeric,
    status_bayar character varying(25)
);


ALTER TABLE pembayaran_in OWNER TO postgres;

--
-- Name: pembayaran_out; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pembayaran_out (
    idbayar integer NOT NULL,
    supplier character varying(50),
    tgl_trans date,
    tgl_bayar date,
    jumlahbayar numeric,
    status_bayar character varying(25)
);


ALTER TABLE pembayaran_out OWNER TO postgres;

--
-- Name: pembelian; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pembelian (
    idbeli integer NOT NULL,
    idbayar integer,
    supplier character varying(50),
    produk character varying(50),
    tgl_beli date,
    tgl_terima date,
    cara_terima character varying(25),
    cara_bayar character varying(25),
    status_del character varying(25),
    harga_total numeric,
    karton numeric,
    kilo numeric
);


ALTER TABLE pembelian OWNER TO postgres;

--
-- Name: pengguna; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE pengguna (
    username character varying(25) NOT NULL,
    nama character varying(50),
    password character varying,
    role character varying(25)
);


ALTER TABLE pengguna OWNER TO postgres;

--
-- Name: penjualan; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE penjualan (
    idjual integer NOT NULL,
    idbayar integer,
    customer character varying(50),
    produk character varying(50),
    tgl_jual date,
    tgl_kirim date,
    jatuh_tempo date,
    jam_kirim time without time zone,
    cara_kirim character varying(25),
    cara_bayar character varying(25),
    status_del character varying(25),
    harga_total numeric,
    karton numeric,
    kilo numeric
);


ALTER TABLE penjualan OWNER TO postgres;

--
-- Name: produk; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE produk (
    idmerk integer NOT NULL,
    idjenis integer NOT NULL,
    lokasi character varying(25) NOT NULL,
    namaproduk character varying(50),
    harga_beli integer,
    harga_jual integer,
    kilo numeric,
    karton numeric
);


ALTER TABLE produk OWNER TO postgres;

--
-- Name: role; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE role (
    id integer NOT NULL,
    role character varying(25)
);


ALTER TABLE role OWNER TO postgres;

--
-- Name: supplier; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE supplier (
    idsupplier integer NOT NULL,
    namasupplier character varying(50),
    telponsupplier character varying(50),
    alamatsupplier character varying(100),
    no_rekening character varying(50)
);


ALTER TABLE supplier OWNER TO postgres;

--
-- Data for Name: customer; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY customer (idcustomer, namacustomer, telponcustomer, alamatcustomer) FROM stdin;
1000000001	Lotte Mart	021123456	Jl. Rajawali  02, Jakarta Timur
1000000002	Hotel Santika	021123457	Perum Gandasari 05, Jakarta Selatan
1000000003	Hotel Bumiwiyata	021123458	Mares Margonda, Depok
1000000004	Resto McDonald	021123459	Pondok Pepaya Asri, Depok
1000000005	Resto KFC	021123451	Jl. Jatiasih, Bekasi
1000000006	Resto AW	021123452	Pondok Cabe, Tangerang Selatan
1000000007	Modena Resto	021123453	Jl. Kenanga Raya, Bekasi
1000000008	Delicia Hotel	021123454	Jl. Arjuna No. 20, Jakarta Utara
1000000009	Burger King	021123455	Jl. Bulog Rante, Jakarta Timur
1000000010	Hollycow	021123450	Jl. Kapten P. Tendean, Jakarta Pusat 
\.


--
-- Data for Name: jenis; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY jenis (idjenis, namajenis, rop, stok_kilo, stok_karton) FROM stdin;
400000001	Sirloin	150	650	35
400000002	Hati	0	0	0
400000003	Knuckle	100	500	35
400000004	Striploin	60	350	23
400000005	Cubroll	90	700	45
400000006	Chuck	130	450	30
400000007	Shank	200	900	50
400000008	Oxtail	130	300	18
400000009	Rib eye	80	450	25
400000010	Shorttrib	150	600	35
\.


--
-- Data for Name: merk; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY merk (idmerk, idsupplier, namasupplier, status) FROM stdin;
300000001	2000000001	Affco	aktif
300000002	2000000010	Moonbeef	aktif
300000003	2000000002	Teys	aktif
300000004	2000000003	G.Lea	aktif
300000005	2000000004	Riverland	aktif
300000006	2000000005	Raplh	aktif
300000007	2000000006	Alliance	aktif
300000008	2000000007	Hantervaley	aktif
300000009	2000000008	Harvey	aktif
300000010	2000000009	Hill Top	aktif
\.


--
-- Data for Name: pembayaran_in; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pembayaran_in (idbayar, customer, tgl_trans, tgl_bayar, jumlahbayar, status_bayar) FROM stdin;
\.


--
-- Data for Name: pembayaran_out; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pembayaran_out (idbayar, supplier, tgl_trans, tgl_bayar, jumlahbayar, status_bayar) FROM stdin;
\.


--
-- Data for Name: pembelian; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pembelian (idbeli, idbayar, supplier, produk, tgl_beli, tgl_terima, cara_terima, cara_bayar, status_del, harga_total, karton, kilo) FROM stdin;
\.


--
-- Data for Name: pengguna; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY pengguna (username, nama, password, role) FROM stdin;
gitavns	gita venesia	$2y$13$BnSe17SNoHRugDiGhxKnveE0xlq3EkKwhynN8f.bS26r3WjjkYxBy	purchasing
purchasing02	Winny Claudia	$2y$13$dsc1G5m4HFvbmCvVNsi8k.Vy60cVXJC8zJ818cqp1xVArc/EinLz6	purchasing
sm02	Akram Amrullah	$2y$13$f8TS/3h6TRT8PBGP8lD7w.5kU8u4WEXkIDL32gAPN37HLEimFzm5a	sales marketing
inventori02	Fauziah Raihani	$2y$13$RQhWF87EI8ap6crqwmkY8e3eEEF8q.GC6sowEKfysfmHygAFsZzEC	admin inventori
finance02	Binti Nur	$2y$13$/tq4SNCJ4EaZtlKhpSTpWe6vQ8TT4OModYpCIO7smhkR7UWvKYAzu	finance
bod02	Andre Valerian	$2y$13$CsB3NcihjSKI4lK6U.h3C./Xnq8GBOJc/7Rd02bkzwikuiyUYzF4u	bod
admin	Sularjo	$2y$13$ixnSqCNnCoFuoX8s4i3PIest.bX9HNINNTi8RZ2wqcnXWCjgo1OQa	admin
\.


--
-- Data for Name: penjualan; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY penjualan (idjual, idbayar, customer, produk, tgl_jual, tgl_kirim, jatuh_tempo, jam_kirim, cara_kirim, cara_bayar, status_del, harga_total, karton, kilo) FROM stdin;
\.


--
-- Data for Name: produk; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY produk (idmerk, idjenis, lokasi, namaproduk, harga_beli, harga_jual, kilo, karton) FROM stdin;
300000001	400000001	cakung	Sirloin Affco	120000	135000	100	5
300000002	400000001	cakung	Sirloin Moonbeef	110000	130000	200	10
300000003	400000004	cakung	Striploin Teys	115000	125000	150	8
300000004	400000003	cakung	Knuckle G.Lea	150000	160000	200	10
300000005	400000005	cakung	Cubroll Riverland	95000	115000	300	15
300000006	400000006	cakung	Chuck Raplh	130000	145000	200	10
300000007	400000007	cakung	Shank Alliance	200000	220000	300	15
300000008	400000008	bekasi	Oxtail Hantervaley	90000	105000	200	10
300000009	400000009	bekasi	Rib eye Harvey	150000	165000	250	10
300000010	400000010	bekasi	Shorttrib Hill Top	145000	165000	300	20
300000001	400000004	bekasi	Striploin Affco	180000	200000	200	15
300000003	400000001	bekasi	Sirloin Teys	100000	120000	350	20
300000003	400000007	bekasi	Shank Teys	160000	175000	300	20
300000005	400000003	bekasi	Knuckle Riverland	120000	140000	300	25
300000008	400000005	bekasi	Cubroll Hantervaley	200000	230000	400	30
300000007	400000006	cakung	Chuck Alliance	135000	150000	250	20
300000008	400000007	cakung	Shank Hantervaley	120000	145000	300	15
300000004	400000008	bekasi	Oxtail G.Lea	100000	115000	100	8
300000010	400000009	bekasi	Rib eye Hill Top	140000	155000	200	15
300000002	400000010	bekasi	Shorttrib Moonbeef	95000	105000	300	15
\.


--
-- Data for Name: role; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY role (id, role) FROM stdin;
1	sales marketing
2	purchasing
3	admin inventori
4	bod
5	admin
6	finance
\.


--
-- Data for Name: supplier; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY supplier (idsupplier, namasupplier, telponsupplier, alamatsupplier, no_rekening) FROM stdin;
2000000001	PT. Indoguna	021123456	Jl. Kapten P. Tendean, Jakarta Pusat	0987654321
2000000002	PT. Bina Mentari Tunggal	031123457	Pondok Cabe, Tangerang Selatan	12654378965
2000000003	PT. Agro Giri Perkasa	021123458	Mares Margonda, Depok	9876543287
2000000004	Tanjung Unggul Mandiri	0231123459	Perum Gandasari 05, Jakarta Selatan	5643789231
2000000005	PT. Andini Karya Makmur	031123451	Perum Asri Sari 06, Jakarta Barat	432675489
2000000006	Agri Satwa Kencana	021123452	Jl. Rajawali  02, Jakarta Timur	7689543023
2000000007	PT. Pasir Tengah	021123453	Jl. Kenanga Raya, Bekasi	2314567896
2000000008	Widodo Makmur	021123454	Jl. Bulog Rante, Jakarta Timur	9867342512
2000000009	PT. Lembu Perkasa	021123455	Pondok Pepaya Asri, Depok	342156890
2000000010	Jaya Sentosa	021123450	Jl. Jatiasih, Bekasi	1223344567
\.


--
-- Name: customer_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY customer
    ADD CONSTRAINT customer_pkey PRIMARY KEY (idcustomer);


--
-- Name: jenis_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY jenis
    ADD CONSTRAINT jenis_pkey PRIMARY KEY (idjenis);


--
-- Name: merk_idmerk_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY merk
    ADD CONSTRAINT merk_idmerk_key UNIQUE (idmerk);


--
-- Name: merk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY merk
    ADD CONSTRAINT merk_pkey PRIMARY KEY (idmerk, idsupplier);


--
-- Name: pembayaran_in_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pembayaran_in
    ADD CONSTRAINT pembayaran_in_pkey PRIMARY KEY (idbayar);


--
-- Name: pembayaran_out_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pembayaran_out
    ADD CONSTRAINT pembayaran_out_pkey PRIMARY KEY (idbayar);


--
-- Name: pembelian_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pembelian
    ADD CONSTRAINT pembelian_pkey PRIMARY KEY (idbeli);


--
-- Name: pengguna_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pengguna
    ADD CONSTRAINT pengguna_pkey PRIMARY KEY (username);


--
-- Name: penjualan_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY penjualan
    ADD CONSTRAINT penjualan_pkey PRIMARY KEY (idjual);


--
-- Name: produk_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY produk
    ADD CONSTRAINT produk_pkey PRIMARY KEY (idmerk, idjenis, lokasi);


--
-- Name: role_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY role
    ADD CONSTRAINT role_pkey PRIMARY KEY (id);


--
-- Name: supplier_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY supplier
    ADD CONSTRAINT supplier_pkey PRIMARY KEY (idsupplier);


--
-- Name: merk_idsupplier_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY merk
    ADD CONSTRAINT merk_idsupplier_fkey FOREIGN KEY (idsupplier) REFERENCES supplier(idsupplier);


--
-- Name: pembelian_idbayar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY pembelian
    ADD CONSTRAINT pembelian_idbayar_fkey FOREIGN KEY (idbayar) REFERENCES pembayaran_out(idbayar) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: penjualan_idbayar_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY penjualan
    ADD CONSTRAINT penjualan_idbayar_fkey FOREIGN KEY (idbayar) REFERENCES pembayaran_in(idbayar) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: produk_idjenis_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY produk
    ADD CONSTRAINT produk_idjenis_fkey FOREIGN KEY (idjenis) REFERENCES jenis(idjenis) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: produk_idmerk_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY produk
    ADD CONSTRAINT produk_idmerk_fkey FOREIGN KEY (idmerk) REFERENCES merk(idmerk) ON UPDATE CASCADE ON DELETE CASCADE;


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

