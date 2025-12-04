--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5
-- Dumped by pg_dump version 17.5

-- Started on 2025-11-13 10:43:13

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

DROP DATABASE IF EXISTS pdao_db;
--
-- TOC entry 5109 (class 1262 OID 16386)
-- Name: pdao_db; Type: DATABASE; Schema: -; Owner: postgres
--

CREATE DATABASE pdao_db WITH TEMPLATE = template0 ENCODING = 'UTF8' LOCALE_PROVIDER = libc LOCALE = 'English_Philippines.1252';


ALTER DATABASE pdao_db OWNER TO postgres;

\connect pdao_db

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- TOC entry 908 (class 1247 OID 16528)
-- Name: accomplished_by_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.accomplished_by_enum AS ENUM (
    'Applicant',
    'Guardian',
    'Representative'
);


ALTER TYPE public.accomplished_by_enum OWNER TO postgres;

--
-- TOC entry 890 (class 1247 OID 16454)
-- Name: application_status_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.application_status_enum AS ENUM (
    'Pending',
    'Approved',
    'Denied'
);


ALTER TYPE public.application_status_enum OWNER TO postgres;

--
-- TOC entry 887 (class 1247 OID 16447)
-- Name: application_type_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.application_type_enum AS ENUM (
    'New',
    'Renewal',
    'Lost ID',
    'new',
    'renewal',
    'lost'
);


ALTER TYPE public.application_type_enum OWNER TO postgres;

--
-- TOC entry 896 (class 1247 OID 16480)
-- Name: cause_detail_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.cause_detail_enum AS ENUM (
    'Congenital/Inborn',
    'Acquired'
);


ALTER TYPE public.cause_detail_enum OWNER TO postgres;

--
-- TOC entry 881 (class 1247 OID 16416)
-- Name: civil_status_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.civil_status_enum AS ENUM (
    'Single',
    'Married',
    'Separated',
    'Widow/er',
    'Cohabitation'
);


ALTER TYPE public.civil_status_enum OWNER TO postgres;

--
-- TOC entry 938 (class 1247 OID 16676)
-- Name: educational_attainment_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.educational_attainment_enum AS ENUM (
    'None',
    'Kindergarten',
    'Elementary',
    'Junior High School',
    'Senior High School',
    'College',
    'Vocational',
    'Post Graduate'
);


ALTER TYPE public.educational_attainment_enum OWNER TO postgres;

--
-- TOC entry 923 (class 1247 OID 16590)
-- Name: employment_category_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.employment_category_enum AS ENUM (
    'Government',
    'Private',
    'Others'
);


ALTER TYPE public.employment_category_enum OWNER TO postgres;

--
-- TOC entry 920 (class 1247 OID 16582)
-- Name: employment_status_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.employment_status_enum AS ENUM (
    'Employed',
    'Unemployed',
    'Self-employed'
);


ALTER TYPE public.employment_status_enum OWNER TO postgres;

--
-- TOC entry 878 (class 1247 OID 16410)
-- Name: sex_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.sex_enum AS ENUM (
    'Male',
    'Female'
);


ALTER TYPE public.sex_enum OWNER TO postgres;

--
-- TOC entry 926 (class 1247 OID 16598)
-- Name: type_of_employment_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.type_of_employment_enum AS ENUM (
    'Permanent/Regular',
    'Seasonal',
    'Casual',
    'Emergency'
);


ALTER TYPE public.type_of_employment_enum OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- TOC entry 231 (class 1259 OID 16536)
-- Name: accomplishedby; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.accomplishedby (
    accomplishment_id integer NOT NULL,
    application_id integer NOT NULL,
    accomplished_by public.accomplished_by_enum NOT NULL,
    last_name character varying(50),
    first_name character varying(50),
    middle_name character varying(50),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.accomplishedby OWNER TO postgres;

--
-- TOC entry 230 (class 1259 OID 16535)
-- Name: accomplishedby_accomplishment_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.accomplishedby_accomplishment_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.accomplishedby_accomplishment_id_seq OWNER TO postgres;

--
-- TOC entry 5110 (class 0 OID 0)
-- Dependencies: 230
-- Name: accomplishedby_accomplishment_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.accomplishedby_accomplishment_id_seq OWNED BY public.accomplishedby.accomplishment_id;


--
-- TOC entry 237 (class 1259 OID 16608)
-- Name: affiliation; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.affiliation (
    affiliation_id integer NOT NULL,
    applicant_id integer NOT NULL,
    educational_attainment public.educational_attainment_enum,
    employment_status public.employment_status_enum,
    employment_category public.employment_category_enum,
    occupation character varying(100),
    type_of_employment public.type_of_employment_enum,
    organization_affiliated character varying(100),
    contact_person character varying(100),
    office_address character varying(255),
    tel_no character varying(30),
    sss_no character varying(30),
    gsis_no character varying(30),
    pagibig_no character varying(30),
    psn_no character varying(30),
    philhealth_no character varying(30),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.affiliation OWNER TO postgres;

--
-- TOC entry 236 (class 1259 OID 16607)
-- Name: affiliation_affiliation_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.affiliation_affiliation_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.affiliation_affiliation_id_seq OWNER TO postgres;

--
-- TOC entry 5111 (class 0 OID 0)
-- Dependencies: 236
-- Name: affiliation_affiliation_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.affiliation_affiliation_id_seq OWNED BY public.affiliation.affiliation_id;


--
-- TOC entry 221 (class 1259 OID 16436)
-- Name: applicant; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.applicant (
    applicant_id integer NOT NULL,
    pwd_number character varying(16),
    last_name character varying(50),
    first_name character varying(50),
    middle_name character varying(50),
    suffix character varying(10),
    birthdate date,
    sex public.sex_enum,
    civil_status public.civil_status_enum,
    house_no_street character varying(100),
    barangay character varying(50),
    municipality character varying(50),
    province character varying(50),
    region character varying(50),
    landline_no character varying(20),
    mobile_no character varying(20),
    email_address character varying(100),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    user_id integer
);


ALTER TABLE public.applicant OWNER TO postgres;

--
-- TOC entry 220 (class 1259 OID 16435)
-- Name: applicant_applicant_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.applicant_applicant_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.applicant_applicant_id_seq OWNER TO postgres;

--
-- TOC entry 5112 (class 0 OID 0)
-- Dependencies: 220
-- Name: applicant_applicant_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.applicant_applicant_id_seq OWNED BY public.applicant.applicant_id;


--
-- TOC entry 223 (class 1259 OID 16462)
-- Name: application; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.application (
    application_id integer NOT NULL,
    applicant_id integer NOT NULL,
    application_type public.application_type_enum NOT NULL,
    application_date date,
    status public.application_status_enum DEFAULT 'Pending'::public.application_status_enum,
    remarks text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    pic_1x1_path character varying(255),
    approved_by integer,
    approved_at timestamp without time zone
);


ALTER TABLE public.application OWNER TO postgres;

--
-- TOC entry 222 (class 1259 OID 16461)
-- Name: application_application_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.application_application_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.application_application_id_seq OWNER TO postgres;

--
-- TOC entry 5113 (class 0 OID 0)
-- Dependencies: 222
-- Name: application_application_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.application_application_id_seq OWNED BY public.application.application_id;


--
-- TOC entry 243 (class 1259 OID 16718)
-- Name: application_draft; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.application_draft (
    draft_id integer NOT NULL,
    application_id integer NOT NULL,
    step integer NOT NULL,
    data jsonb NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.application_draft OWNER TO postgres;

--
-- TOC entry 242 (class 1259 OID 16717)
-- Name: application_draft_draft_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.application_draft_draft_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.application_draft_draft_id_seq OWNER TO postgres;

--
-- TOC entry 5114 (class 0 OID 0)
-- Dependencies: 242
-- Name: application_draft_draft_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.application_draft_draft_id_seq OWNED BY public.application_draft.draft_id;


--
-- TOC entry 227 (class 1259 OID 16495)
-- Name: causedetail; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.causedetail (
    cause_detail_id integer NOT NULL,
    cause_disability_id integer,
    cause_detail public.cause_detail_enum NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.causedetail OWNER TO postgres;

--
-- TOC entry 226 (class 1259 OID 16494)
-- Name: causedetail_cause_detail_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.causedetail_cause_detail_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.causedetail_cause_detail_id_seq OWNER TO postgres;

--
-- TOC entry 5115 (class 0 OID 0)
-- Dependencies: 226
-- Name: causedetail_cause_detail_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.causedetail_cause_detail_id_seq OWNED BY public.causedetail.cause_detail_id;


--
-- TOC entry 225 (class 1259 OID 16486)
-- Name: causedisability; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.causedisability (
    cause_disability_id integer NOT NULL,
    cause_disability character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.causedisability OWNER TO postgres;

--
-- TOC entry 224 (class 1259 OID 16485)
-- Name: causedisability_cause_disability_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.causedisability_cause_disability_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.causedisability_cause_disability_id_seq OWNER TO postgres;

--
-- TOC entry 5116 (class 0 OID 0)
-- Dependencies: 224
-- Name: causedisability_cause_disability_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.causedisability_cause_disability_id_seq OWNED BY public.causedisability.cause_disability_id;


--
-- TOC entry 233 (class 1259 OID 16550)
-- Name: certification; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.certification (
    certification_id integer NOT NULL,
    application_id integer NOT NULL,
    certifying_physician character varying(100),
    license_no character varying(50),
    processing_officer character varying(100),
    approving_officer character varying(100),
    encoder character varying(100),
    reporting_unit character varying(100),
    control_no character varying(30),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    pwd_cert_path character varying(255)
);


ALTER TABLE public.certification OWNER TO postgres;

--
-- TOC entry 232 (class 1259 OID 16549)
-- Name: certification_certification_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.certification_certification_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.certification_certification_id_seq OWNER TO postgres;

--
-- TOC entry 5117 (class 0 OID 0)
-- Dependencies: 232
-- Name: certification_certification_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.certification_certification_id_seq OWNED BY public.certification.certification_id;


--
-- TOC entry 229 (class 1259 OID 16509)
-- Name: disability; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.disability (
    disability_id integer NOT NULL,
    application_id integer NOT NULL,
    cause_detail_id integer,
    disability_type character varying(100) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.disability OWNER TO postgres;

--
-- TOC entry 228 (class 1259 OID 16508)
-- Name: disability_disability_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.disability_disability_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.disability_disability_id_seq OWNER TO postgres;

--
-- TOC entry 5118 (class 0 OID 0)
-- Dependencies: 228
-- Name: disability_disability_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.disability_disability_id_seq OWNED BY public.disability.disability_id;


--
-- TOC entry 241 (class 1259 OID 16643)
-- Name: documentrequirements; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.documentrequirements (
    document_id integer NOT NULL,
    application_id integer NOT NULL,
    bodypic_path character varying(255),
    pic_1x1_path character varying(255),
    medicalcert_path character varying(255),
    barangaycert_path character varying(255),
    old_pwd_id_path character varying(255),
    affidavit_loss_path character varying(255),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    cho_cert_path text
);


ALTER TABLE public.documentrequirements OWNER TO postgres;

--
-- TOC entry 240 (class 1259 OID 16642)
-- Name: documentrequirements_document_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.documentrequirements_document_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.documentrequirements_document_id_seq OWNER TO postgres;

--
-- TOC entry 5119 (class 0 OID 0)
-- Dependencies: 240
-- Name: documentrequirements_document_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.documentrequirements_document_id_seq OWNED BY public.documentrequirements.document_id;


--
-- TOC entry 239 (class 1259 OID 16627)
-- Name: emergencycontact; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.emergencycontact (
    emergency_id integer NOT NULL,
    applicant_id integer NOT NULL,
    contact_person_name character varying(100) NOT NULL,
    contact_person_no character varying(20) NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.emergencycontact OWNER TO postgres;

--
-- TOC entry 238 (class 1259 OID 16626)
-- Name: emergencycontact_emergency_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.emergencycontact_emergency_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.emergencycontact_emergency_id_seq OWNER TO postgres;

--
-- TOC entry 5120 (class 0 OID 0)
-- Dependencies: 238
-- Name: emergencycontact_emergency_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.emergencycontact_emergency_id_seq OWNED BY public.emergencycontact.emergency_id;


--
-- TOC entry 235 (class 1259 OID 16566)
-- Name: familybackground; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.familybackground (
    family_id integer NOT NULL,
    applicant_id integer NOT NULL,
    father_last_name character varying(50),
    father_first_name character varying(50),
    father_middle_name character varying(50),
    mother_last_name character varying(50),
    mother_first_name character varying(50),
    mother_middle_name character varying(50),
    guardian_last_name character varying(50),
    guardian_first_name character varying(50),
    guardian_middle_name character varying(50),
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
);


ALTER TABLE public.familybackground OWNER TO postgres;

--
-- TOC entry 234 (class 1259 OID 16565)
-- Name: familybackground_family_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.familybackground_family_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.familybackground_family_id_seq OWNER TO postgres;

--
-- TOC entry 5121 (class 0 OID 0)
-- Dependencies: 234
-- Name: familybackground_family_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.familybackground_family_id_seq OWNED BY public.familybackground.family_id;


--
-- TOC entry 219 (class 1259 OID 16395)
-- Name: user_account; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_account (
    user_id integer NOT NULL,
    email character varying(100) NOT NULL,
    password_hash text NOT NULL,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    first_name character varying(50),
    last_name character varying(50)
);


ALTER TABLE public.user_account OWNER TO postgres;

--
-- TOC entry 218 (class 1259 OID 16394)
-- Name: user_account_user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_account_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_account_user_id_seq OWNER TO postgres;

--
-- TOC entry 5122 (class 0 OID 0)
-- Dependencies: 218
-- Name: user_account_user_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.user_account_user_id_seq OWNED BY public.user_account.user_id;


--
-- TOC entry 217 (class 1259 OID 16387)
-- Name: user_admin; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.user_admin (
    username character varying(50) NOT NULL,
    password text NOT NULL,
    role text,
    is_admin boolean DEFAULT false,
    is_doctor boolean DEFAULT false
);


ALTER TABLE public.user_admin OWNER TO postgres;

--
-- TOC entry 4857 (class 2604 OID 16539)
-- Name: accomplishedby accomplishment_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accomplishedby ALTER COLUMN accomplishment_id SET DEFAULT nextval('public.accomplishedby_accomplishment_id_seq'::regclass);


--
-- TOC entry 4866 (class 2604 OID 16611)
-- Name: affiliation affiliation_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation ALTER COLUMN affiliation_id SET DEFAULT nextval('public.affiliation_affiliation_id_seq'::regclass);


--
-- TOC entry 4841 (class 2604 OID 16439)
-- Name: applicant applicant_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applicant ALTER COLUMN applicant_id SET DEFAULT nextval('public.applicant_applicant_id_seq'::regclass);


--
-- TOC entry 4844 (class 2604 OID 16465)
-- Name: application application_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application ALTER COLUMN application_id SET DEFAULT nextval('public.application_application_id_seq'::regclass);


--
-- TOC entry 4875 (class 2604 OID 16721)
-- Name: application_draft draft_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_draft ALTER COLUMN draft_id SET DEFAULT nextval('public.application_draft_draft_id_seq'::regclass);


--
-- TOC entry 4851 (class 2604 OID 16498)
-- Name: causedetail cause_detail_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedetail ALTER COLUMN cause_detail_id SET DEFAULT nextval('public.causedetail_cause_detail_id_seq'::regclass);


--
-- TOC entry 4848 (class 2604 OID 16489)
-- Name: causedisability cause_disability_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedisability ALTER COLUMN cause_disability_id SET DEFAULT nextval('public.causedisability_cause_disability_id_seq'::regclass);


--
-- TOC entry 4860 (class 2604 OID 16553)
-- Name: certification certification_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certification ALTER COLUMN certification_id SET DEFAULT nextval('public.certification_certification_id_seq'::regclass);


--
-- TOC entry 4854 (class 2604 OID 16512)
-- Name: disability disability_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability ALTER COLUMN disability_id SET DEFAULT nextval('public.disability_disability_id_seq'::regclass);


--
-- TOC entry 4872 (class 2604 OID 16646)
-- Name: documentrequirements document_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentrequirements ALTER COLUMN document_id SET DEFAULT nextval('public.documentrequirements_document_id_seq'::regclass);


--
-- TOC entry 4869 (class 2604 OID 16630)
-- Name: emergencycontact emergency_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact ALTER COLUMN emergency_id SET DEFAULT nextval('public.emergencycontact_emergency_id_seq'::regclass);


--
-- TOC entry 4863 (class 2604 OID 16569)
-- Name: familybackground family_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground ALTER COLUMN family_id SET DEFAULT nextval('public.familybackground_family_id_seq'::regclass);


--
-- TOC entry 4838 (class 2604 OID 16398)
-- Name: user_account user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account ALTER COLUMN user_id SET DEFAULT nextval('public.user_account_user_id_seq'::regclass);


--
-- TOC entry 5091 (class 0 OID 16536)
-- Dependencies: 231
-- Data for Name: accomplishedby; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5097 (class 0 OID 16608)
-- Dependencies: 237
-- Data for Name: affiliation; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5081 (class 0 OID 16436)
-- Dependencies: 221
-- Data for Name: applicant; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.applicant VALUES (1, NULL, 'Ancog', 'Thea', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-07-29 15:48:10.123944', '2025-07-29 15:48:10.123944', 8) ON CONFLICT DO NOTHING;
INSERT INTO public.applicant VALUES (2, NULL, 'Bautista', 'Van', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-08-18 13:48:26.772338', '2025-08-18 13:48:26.772338', 9) ON CONFLICT DO NOTHING;


--
-- TOC entry 5083 (class 0 OID 16462)
-- Dependencies: 223
-- Data for Name: application; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.application VALUES (1, 1, 'new', '2025-07-30', 'Pending', NULL, '2025-07-30 12:01:46.914651', '2025-07-30 12:01:46.914651', NULL, NULL, NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.application VALUES (2, 1, 'new', '2025-07-30', 'Pending', NULL, '2025-07-30 22:09:23.346109', '2025-07-30 22:09:23.346109', NULL, NULL, NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.application VALUES (3, 1, 'new', '2025-07-31', 'Pending', NULL, '2025-07-31 12:21:19.154504', '2025-07-31 12:21:19.154504', NULL, NULL, NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.application VALUES (4, 1, 'Renewal', NULL, 'Pending', NULL, '2025-08-08 23:44:57.802909', '2025-08-08 23:44:57.802909', NULL, NULL, NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.application VALUES (5, 1, 'New', NULL, 'Pending', NULL, '2025-08-12 14:43:08.070373', '2025-08-14 12:51:20.030512', '/uploads/1755147080_22e806c9.png', NULL, NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.application VALUES (6, 2, 'New', NULL, 'Pending', NULL, '2025-08-18 13:48:28.342067', '2025-08-18 13:48:28.342067', NULL, NULL, NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.application VALUES (7, 1, 'Lost ID', NULL, 'Pending', NULL, '2025-10-07 14:05:24.375232', '2025-10-07 14:05:24.375232', NULL, NULL, NULL) ON CONFLICT DO NOTHING;


--
-- TOC entry 5103 (class 0 OID 16718)
-- Dependencies: 243
-- Data for Name: application_draft; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.application_draft VALUES (94, 3, 3, '{"encoder": "", "control_no": "", "license_no": "", "reporting_unit": "", "approving_officer": "", "contact_person_no": "12345679", "processing_officer": "", "contact_person_name": "ansdgsg", "certifying_physician": ""}', '2025-07-31 12:22:49.15763', '2025-07-31 15:50:26.736088') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (1, 1, 1, '{"sex": "Female", "cause": "Congenital/Inborn", "region": "X", "suffix": "", "barangay": "Hinaplanon", "province": "Lanao Del Norte", "birthdate": "2000-08-20", "last_name": "Anc", "mobile_no": "23424242", "first_name": "Anna", "landline_no": "221-0001", "middle_name": "Tan", "civil_status": "Single", "date_applied": "2025-03-07", "municipality": "", "applicantType": "new", "email_address": "thea.ancog@g.msuiit.edu.ph", "disability_type": "Intellectual Disability", "house_no_street": "2", "cause_description": "ADHD"}', '2025-07-30 12:02:45.69716', '2025-07-30 13:35:40.344811') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (154, 5, 1, '{"sex": "Male", "cause": "Acquired", "region": "X", "suffix": "sfsgsg", "barangay": "Hinaplanon", "province": "Lanao Del Norte", "birthdate": "2005-05-05", "last_name": "Ancasd", "mobile_no": "0213456789", "first_name": "sdfd", "landline_no": "221-0001", "middle_name": "sdf", "civil_status": "Single", "municipality": "", "pic_1x1_path": "/uploads/1755147080_22e806c9.png", "applicantType": "new", "email_address": "thea.ancog@g.msuiit.edu.ph", "disability_type": "Intellectual Disability", "house_no_street": "Acmac IC", "application_date": "2025-08-08", "cause_description": "Cerebral Palsy"}', '2025-08-12 14:43:10.511412', '2025-11-10 10:08:49.332526') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (4, 1, 2, '{"sss_no": "4646", "tel_no": "adsad", "gsis_no": "46464", "occupation": "Managers", "pagibig_no": "45646", "philhealth_no": "4546", "contact_person": "adad", "office_address": "adsad", "accomplished_by": "Guardian", "father_last_name": "jhb", "mother_last_name": "adasdad", "employment_status": "Employed", "father_first_name": "afdaf", "mother_first_name": "Roy", "occupation_others": "", "father_middle_name": "Acero", "guardian_last_name": "Ancog", "mother_middle_name": "Acero", "type_of_employment": "Permanent/Regular", "employment_category": "Government", "guardian_first_name": "Rose", "guardian_middle_name": "Acero", "acc_last_name_guardian": "asdsad", "educational_attainment": "Kindergarten", "acc_first_name_guardian": "adsad", "organization_affiliated": "sdad", "acc_middle_name_guardian": "adad"}', '2025-07-30 12:19:33.326925', '2025-07-30 13:58:43.490241') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (31, 3, 1, '{"sex": "Female", "cause": "Congenital/Inborn", "region": "X", "suffix": "", "barangay": "Hinaplanon", "province": "Lanao Del Norte", "birthdate": "2025-07-31", "last_name": "Ancog", "mobile_no": "52655", "first_name": "Rose", "landline_no": "221-0001", "middle_name": "Acero", "civil_status": "Single", "date_applied": "2025-03-07", "municipality": "", "applicantType": "renew", "email_address": "thea.ancog@g.msuiit.edu.ph", "disability_type": "Learning Disability", "house_no_street": "2", "cause_description": "ADHD"}', '2025-07-31 12:21:23.7833', '2025-07-31 15:50:23.77755') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (66, 3, 2, '{"sss_no": "4646", "tel_no": "adsad", "gsis_no": "46464", "occupation": "Managers", "pagibig_no": "45646", "philhealth_no": "4546", "contact_person": "adad", "office_address": "adsad", "accomplished_by": "Applicant", "father_last_name": "jhb", "mother_last_name": "adasdad", "employment_status": "Employed", "father_first_name": "afdaf", "mother_first_name": "Roy", "occupation_others": "", "father_middle_name": "Acero", "guardian_last_name": "Ancog", "mother_middle_name": "Acero", "type_of_employment": "Permanent/Regular", "employment_category": "Government", "guardian_first_name": "Rose", "guardian_middle_name": "Acero", "educational_attainment": "College", "acc_last_name_applicant": "Anna", "organization_affiliated": "sdad", "acc_first_name_applicant": "Tan", "acc_middle_name_applicant": "Anc"}', '2025-07-31 12:22:10.848641', '2025-07-31 15:50:25.291643') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (279, 5, 4, '{"nav": "back", "bodypic_path": "/uploads/photos/1755153508_5e1eed69.pdf", "cho_cert_path": "", "medicalcert_path": "/PWD-Application-System/uploads/1762149510_Doctor-Side.pdf", "barangaycert_path": "/uploads/docs/1755153125_1da87e8c.png"}', '2025-08-14 10:13:39.344645', '2025-11-10 10:09:11.462932') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (132, 4, 1, '{"sex": "Male", "cause": "Acquired", "region": "X", "suffix": "sfsgsg", "barangay": "Hinaplanon", "province": "Lanao Del Norte", "birthdate": "2005-05-05", "last_name": "Ancasd", "mobile_no": "0213456789", "first_name": "sdfd", "landline_no": "221-0001", "middle_name": "sdf", "civil_status": "Single", "municipality": "", "pic_1x1_path": "", "applicantType": "renew", "email_address": "thea.ancog@g.msuiit.edu.ph", "disability_type": "Intellectual Disability", "house_no_street": "Acmac IC", "application_date": "2025-08-08", "cause_description": "Cerebral Palsy"}', '2025-08-08 23:45:02.317294', '2025-10-07 14:05:13.994675') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (11, 1, 3, '{"encoder": "", "control_no": "", "license_no": "", "reporting_unit": "", "approving_officer": "", "contact_person_no": "123456790", "processing_officer": "", "contact_person_name": "ansdgsg", "certifying_physician": ""}', '2025-07-30 13:58:45.795193', '2025-07-30 14:03:14.356919') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (400, 4, 4, '{"nav": "back", "cho_cert_path": "", "old_pwd_id_path": "", "medicalcert_path": "", "barangaycert_path": ""}', '2025-09-16 13:27:18.547437', '2025-09-16 13:53:25.604165') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (398, 4, 2, '{"sss_no": "", "tel_no": "", "gsis_no": "", "pagibig_no": "", "philhealth_no": "", "contact_person": "", "office_address": "", "father_last_name": "", "mother_last_name": "", "employment_status": "", "father_first_name": "", "mother_first_name": "", "occupation_others": "", "father_middle_name": "", "guardian_last_name": "", "mother_middle_name": "", "type_of_employment": "", "employment_category": "", "guardian_first_name": "", "guardian_middle_name": "", "educational_attainment": "", "organization_affiliated": ""}', '2025-09-16 13:18:27.760503', '2025-10-07 14:05:16.926247') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (399, 4, 3, '{"nav": "next", "encoder": "", "control_no": "", "license_no": "", "reporting_unit": "", "approving_officer": "", "contact_person_no": "", "processing_officer": "", "contact_person_name": "", "certifying_physician": ""}', '2025-09-16 13:18:31.338657', '2025-10-07 14:05:19.57408') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (275, 5, 3, '{"nav": "back", "encoder": "", "control_no": "", "license_no": "", "reporting_unit": "", "approving_officer": "", "contact_person_no": "12345679", "processing_officer": "", "contact_person_name": "ansdgsg", "certifying_physician": ""}', '2025-08-13 16:04:49.616349', '2025-11-10 10:09:14.395836') ON CONFLICT DO NOTHING;
INSERT INTO public.application_draft VALUES (229, 5, 2, '{"sss_no": "12656", "tel_no": "jbjkbjb", "gsis_no": "45455546", "occupation": "Managers", "pagibig_no": "75756", "philhealth_no": "5645645", "contact_person": "Rose Acero Ancog", "office_address": "2", "accomplished_by": "Guardian", "father_last_name": "Anc", "mother_last_name": "Anc", "employment_status": "Unemployed", "father_first_name": "adsad", "mother_first_name": "Anna", "occupation_others": "", "father_middle_name": "Tan", "guardian_last_name": "Anc", "mother_middle_name": "Tan", "type_of_employment": "Permanent/Regular", "employment_category": "Private", "guardian_first_name": "gsfgs", "guardian_middle_name": "Tan", "acc_last_name_guardian": "akjfbkajsbfja", "educational_attainment": "Kindergarten", "acc_first_name_guardian": "Tan", "organization_affiliated": "jbkj", "acc_middle_name_guardian": "Anc"}', '2025-08-13 14:54:04.13014', '2025-11-10 10:08:51.264459') ON CONFLICT DO NOTHING;


--
-- TOC entry 5087 (class 0 OID 16495)
-- Dependencies: 227
-- Data for Name: causedetail; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5085 (class 0 OID 16486)
-- Dependencies: 225
-- Data for Name: causedisability; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5093 (class 0 OID 16550)
-- Dependencies: 233
-- Data for Name: certification; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5089 (class 0 OID 16509)
-- Dependencies: 229
-- Data for Name: disability; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5101 (class 0 OID 16643)
-- Dependencies: 241
-- Data for Name: documentrequirements; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.documentrequirements VALUES (1, 5, '/uploads/photos/1755153508_5e1eed69.pdf', NULL, '/PWD-Application-System/uploads/1762149510_Doctor-Side.pdf', '/uploads/docs/1755153125_1da87e8c.png', NULL, '/PWD-Application-System/uploads/1755761887_Doctor-Side.pdf', '2025-08-14 10:13:23.134755', '2025-11-10 10:09:11.467724', NULL) ON CONFLICT DO NOTHING;
INSERT INTO public.documentrequirements VALUES (2, 4, NULL, NULL, NULL, NULL, NULL, NULL, '2025-09-16 13:27:18.572423', '2025-09-16 13:53:25.622502', NULL) ON CONFLICT DO NOTHING;


--
-- TOC entry 5099 (class 0 OID 16627)
-- Dependencies: 239
-- Data for Name: emergencycontact; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5095 (class 0 OID 16566)
-- Dependencies: 235
-- Data for Name: familybackground; Type: TABLE DATA; Schema: public; Owner: postgres
--



--
-- TOC entry 5079 (class 0 OID 16395)
-- Dependencies: 219
-- Data for Name: user_account; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.user_account VALUES (8, 'thea.ancog@g.msuiit.edu.ph', '$2y$10$H3bXkZi32ujilnEG.ctcbO4BrXsu6swNHQ6RXsNfLg1S5flEm4m46', '2025-07-14 15:25:42.094503', '2025-07-14 15:25:42.094503', 'Thea', 'Ancog') ON CONFLICT DO NOTHING;
INSERT INTO public.user_account VALUES (9, 'vanbautista@gmail.com', '$2y$10$fDIynEPL8ypPSBCRvj3vqOGAsaokObBb8FiCjVzWmbzb9ogyufv8.', '2025-07-14 20:44:05.745059', '2025-07-14 20:44:05.745059', 'Van', 'Bautista') ON CONFLICT DO NOTHING;


--
-- TOC entry 5077 (class 0 OID 16387)
-- Dependencies: 217
-- Data for Name: user_admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

INSERT INTO public.user_admin VALUES ('adminpdao', '$adminpass', NULL, false, false) ON CONFLICT DO NOTHING;
INSERT INTO public.user_admin VALUES ('admin', 'admin123', NULL, false, false) ON CONFLICT DO NOTHING;
INSERT INTO public.user_admin VALUES ('admintest', 'admin123', 'admin', true, false) ON CONFLICT DO NOTHING;


--
-- TOC entry 5123 (class 0 OID 0)
-- Dependencies: 230
-- Name: accomplishedby_accomplishment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.accomplishedby_accomplishment_id_seq', 1, false);


--
-- TOC entry 5124 (class 0 OID 0)
-- Dependencies: 236
-- Name: affiliation_affiliation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.affiliation_affiliation_id_seq', 1, false);


--
-- TOC entry 5125 (class 0 OID 0)
-- Dependencies: 220
-- Name: applicant_applicant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.applicant_applicant_id_seq', 2, true);


--
-- TOC entry 5126 (class 0 OID 0)
-- Dependencies: 222
-- Name: application_application_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_application_id_seq', 7, true);


--
-- TOC entry 5127 (class 0 OID 0)
-- Dependencies: 242
-- Name: application_draft_draft_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_draft_draft_id_seq', 503, true);


--
-- TOC entry 5128 (class 0 OID 0)
-- Dependencies: 226
-- Name: causedetail_cause_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.causedetail_cause_detail_id_seq', 1, false);


--
-- TOC entry 5129 (class 0 OID 0)
-- Dependencies: 224
-- Name: causedisability_cause_disability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.causedisability_cause_disability_id_seq', 1, false);


--
-- TOC entry 5130 (class 0 OID 0)
-- Dependencies: 232
-- Name: certification_certification_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.certification_certification_id_seq', 1, false);


--
-- TOC entry 5131 (class 0 OID 0)
-- Dependencies: 228
-- Name: disability_disability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.disability_disability_id_seq', 1, false);


--
-- TOC entry 5132 (class 0 OID 0)
-- Dependencies: 240
-- Name: documentrequirements_document_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documentrequirements_document_id_seq', 2, true);


--
-- TOC entry 5133 (class 0 OID 0)
-- Dependencies: 238
-- Name: emergencycontact_emergency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.emergencycontact_emergency_id_seq', 1, false);


--
-- TOC entry 5134 (class 0 OID 0)
-- Dependencies: 234
-- Name: familybackground_family_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.familybackground_family_id_seq', 1, false);


--
-- TOC entry 5135 (class 0 OID 0)
-- Dependencies: 218
-- Name: user_account_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_account_user_id_seq', 9, true);


--
-- TOC entry 4898 (class 2606 OID 16543)
-- Name: accomplishedby accomplishedby_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accomplishedby
    ADD CONSTRAINT accomplishedby_pkey PRIMARY KEY (accomplishment_id);


--
-- TOC entry 4906 (class 2606 OID 16617)
-- Name: affiliation affiliation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation
    ADD CONSTRAINT affiliation_pkey PRIMARY KEY (affiliation_id);


--
-- TOC entry 4887 (class 2606 OID 16445)
-- Name: applicant applicant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applicant
    ADD CONSTRAINT applicant_pkey PRIMARY KEY (applicant_id);


--
-- TOC entry 4917 (class 2606 OID 16727)
-- Name: application_draft application_draft_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_draft
    ADD CONSTRAINT application_draft_pkey PRIMARY KEY (draft_id);


--
-- TOC entry 4889 (class 2606 OID 16473)
-- Name: application application_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT application_pkey PRIMARY KEY (application_id);


--
-- TOC entry 4894 (class 2606 OID 16502)
-- Name: causedetail causedetail_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedetail
    ADD CONSTRAINT causedetail_pkey PRIMARY KEY (cause_detail_id);


--
-- TOC entry 4892 (class 2606 OID 16493)
-- Name: causedisability causedisability_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedisability
    ADD CONSTRAINT causedisability_pkey PRIMARY KEY (cause_disability_id);


--
-- TOC entry 4900 (class 2606 OID 16559)
-- Name: certification certification_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certification
    ADD CONSTRAINT certification_pkey PRIMARY KEY (certification_id);


--
-- TOC entry 4896 (class 2606 OID 16516)
-- Name: disability disability_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability
    ADD CONSTRAINT disability_pkey PRIMARY KEY (disability_id);


--
-- TOC entry 4915 (class 2606 OID 16652)
-- Name: documentrequirements documentrequirements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentrequirements
    ADD CONSTRAINT documentrequirements_pkey PRIMARY KEY (document_id);


--
-- TOC entry 4910 (class 2606 OID 16634)
-- Name: emergencycontact emergencycontact_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact
    ADD CONSTRAINT emergencycontact_pkey PRIMARY KEY (emergency_id);


--
-- TOC entry 4902 (class 2606 OID 16573)
-- Name: familybackground familybackground_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground
    ADD CONSTRAINT familybackground_pkey PRIMARY KEY (family_id);


--
-- TOC entry 4908 (class 2606 OID 16625)
-- Name: affiliation unique_affiliation_applicant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation
    ADD CONSTRAINT unique_affiliation_applicant UNIQUE (applicant_id);


--
-- TOC entry 4919 (class 2606 OID 16729)
-- Name: application_draft unique_application_step; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_draft
    ADD CONSTRAINT unique_application_step UNIQUE (application_id, step);


--
-- TOC entry 4881 (class 2606 OID 16659)
-- Name: user_account unique_email; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT unique_email UNIQUE (email);


--
-- TOC entry 4912 (class 2606 OID 16641)
-- Name: emergencycontact unique_emergencycontact_applicant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact
    ADD CONSTRAINT unique_emergencycontact_applicant UNIQUE (applicant_id);


--
-- TOC entry 4904 (class 2606 OID 16580)
-- Name: familybackground unique_familybackground_applicant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground
    ADD CONSTRAINT unique_familybackground_applicant UNIQUE (applicant_id);


--
-- TOC entry 4883 (class 2606 OID 16408)
-- Name: user_account user_account_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_email_key UNIQUE (email);


--
-- TOC entry 4885 (class 2606 OID 16404)
-- Name: user_account user_account_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_pkey PRIMARY KEY (user_id);


--
-- TOC entry 4879 (class 2606 OID 16393)
-- Name: user_admin user_admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_admin
    ADD CONSTRAINT user_admin_pkey PRIMARY KEY (username);


--
-- TOC entry 4913 (class 1259 OID 16745)
-- Name: documentrequirements_appid_key; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX documentrequirements_appid_key ON public.documentrequirements USING btree (application_id);


--
-- TOC entry 4890 (class 1259 OID 16743)
-- Name: uniq_active_draft_per_applicant_type; Type: INDEX; Schema: public; Owner: postgres
--

CREATE UNIQUE INDEX uniq_active_draft_per_applicant_type ON public.application USING btree (applicant_id, application_type) WHERE (application_date IS NULL);


--
-- TOC entry 4925 (class 2606 OID 16544)
-- Name: accomplishedby accomplishedby_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accomplishedby
    ADD CONSTRAINT accomplishedby_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4928 (class 2606 OID 16618)
-- Name: affiliation affiliation_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation
    ADD CONSTRAINT affiliation_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4921 (class 2606 OID 16474)
-- Name: application application_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT application_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4931 (class 2606 OID 16730)
-- Name: application_draft application_draft_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application_draft
    ADD CONSTRAINT application_draft_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4922 (class 2606 OID 16503)
-- Name: causedetail causedetail_cause_disability_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedetail
    ADD CONSTRAINT causedetail_cause_disability_id_fkey FOREIGN KEY (cause_disability_id) REFERENCES public.causedisability(cause_disability_id) ON DELETE SET NULL;


--
-- TOC entry 4926 (class 2606 OID 16560)
-- Name: certification certification_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certification
    ADD CONSTRAINT certification_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4923 (class 2606 OID 16517)
-- Name: disability disability_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability
    ADD CONSTRAINT disability_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4924 (class 2606 OID 16522)
-- Name: disability disability_cause_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability
    ADD CONSTRAINT disability_cause_detail_id_fkey FOREIGN KEY (cause_detail_id) REFERENCES public.causedetail(cause_detail_id) ON DELETE SET NULL;


--
-- TOC entry 4930 (class 2606 OID 16653)
-- Name: documentrequirements documentrequirements_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentrequirements
    ADD CONSTRAINT documentrequirements_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4929 (class 2606 OID 16635)
-- Name: emergencycontact emergencycontact_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact
    ADD CONSTRAINT emergencycontact_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4927 (class 2606 OID 16574)
-- Name: familybackground familybackground_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground
    ADD CONSTRAINT familybackground_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4920 (class 2606 OID 16712)
-- Name: applicant fk_applicant_user; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applicant
    ADD CONSTRAINT fk_applicant_user FOREIGN KEY (user_id) REFERENCES public.user_account(user_id) ON DELETE CASCADE;


-- Completed on 2025-11-13 10:43:13

--
-- PostgreSQL database dump complete
--

