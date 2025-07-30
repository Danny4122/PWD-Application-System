--
-- PostgreSQL database dump
--

-- Dumped from database version 17.5
-- Dumped by pg_dump version 17.5

-- Started on 2025-07-21 22:27:58

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
-- TOC entry 4 (class 2615 OID 2200)
-- Name: public; Type: SCHEMA; Schema: -; Owner: pg_database_owner
--

CREATE SCHEMA public;


ALTER SCHEMA public OWNER TO pg_database_owner;

--
-- TOC entry 5089 (class 0 OID 0)
-- Dependencies: 4
-- Name: SCHEMA public; Type: COMMENT; Schema: -; Owner: pg_database_owner
--

COMMENT ON SCHEMA public IS 'standard public schema';


--
-- TOC entry 906 (class 1247 OID 16528)
-- Name: accomplished_by_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.accomplished_by_enum AS ENUM (
    'Applicant',
    'Guardian',
    'Representative'
);


ALTER TYPE public.accomplished_by_enum OWNER TO postgres;

--
-- TOC entry 888 (class 1247 OID 16454)
-- Name: application_status_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.application_status_enum AS ENUM (
    'Pending',
    'Approved',
    'Denied'
);


ALTER TYPE public.application_status_enum OWNER TO postgres;

--
-- TOC entry 885 (class 1247 OID 16447)
-- Name: application_type_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.application_type_enum AS ENUM (
    'New',
    'Renewal',
    'Lost ID'
);


ALTER TYPE public.application_type_enum OWNER TO postgres;

--
-- TOC entry 894 (class 1247 OID 16480)
-- Name: cause_detail_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.cause_detail_enum AS ENUM (
    'Congenital/Inborn',
    'Acquired'
);


ALTER TYPE public.cause_detail_enum OWNER TO postgres;

--
-- TOC entry 879 (class 1247 OID 16416)
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
-- TOC entry 921 (class 1247 OID 16590)
-- Name: employment_category_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.employment_category_enum AS ENUM (
    'Government',
    'Private',
    'Others'
);


ALTER TYPE public.employment_category_enum OWNER TO postgres;

--
-- TOC entry 918 (class 1247 OID 16582)
-- Name: employment_status_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.employment_status_enum AS ENUM (
    'Employed',
    'Unemployed',
    'Self-employed'
);


ALTER TYPE public.employment_status_enum OWNER TO postgres;

--
-- TOC entry 876 (class 1247 OID 16410)
-- Name: sex_enum; Type: TYPE; Schema: public; Owner: postgres
--

CREATE TYPE public.sex_enum AS ENUM (
    'Male',
    'Female'
);


ALTER TYPE public.sex_enum OWNER TO postgres;

--
-- TOC entry 924 (class 1247 OID 16598)
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
-- TOC entry 5090 (class 0 OID 0)
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
    educational_attainment character varying(100),
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
-- TOC entry 5091 (class 0 OID 0)
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
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
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
-- TOC entry 5092 (class 0 OID 0)
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
    application_date date DEFAULT CURRENT_DATE,
    status public.application_status_enum DEFAULT 'Pending'::public.application_status_enum,
    remarks text,
    created_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP,
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
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
-- TOC entry 5093 (class 0 OID 0)
-- Dependencies: 222
-- Name: application_application_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: postgres
--

ALTER SEQUENCE public.application_application_id_seq OWNED BY public.application.application_id;


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
-- TOC entry 5094 (class 0 OID 0)
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
-- TOC entry 5095 (class 0 OID 0)
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
-- TOC entry 5096 (class 0 OID 0)
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
-- TOC entry 5097 (class 0 OID 0)
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
    updated_at timestamp without time zone DEFAULT CURRENT_TIMESTAMP
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
-- TOC entry 5098 (class 0 OID 0)
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
-- TOC entry 5099 (class 0 OID 0)
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
-- TOC entry 5100 (class 0 OID 0)
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
    applicant_id integer,
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
-- TOC entry 5101 (class 0 OID 0)
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
    password text NOT NULL
);


ALTER TABLE public.user_admin OWNER TO postgres;

--
-- TOC entry 4848 (class 2604 OID 16539)
-- Name: accomplishedby accomplishment_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accomplishedby ALTER COLUMN accomplishment_id SET DEFAULT nextval('public.accomplishedby_accomplishment_id_seq'::regclass);


--
-- TOC entry 4857 (class 2604 OID 16611)
-- Name: affiliation affiliation_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation ALTER COLUMN affiliation_id SET DEFAULT nextval('public.affiliation_affiliation_id_seq'::regclass);


--
-- TOC entry 4831 (class 2604 OID 16439)
-- Name: applicant applicant_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applicant ALTER COLUMN applicant_id SET DEFAULT nextval('public.applicant_applicant_id_seq'::regclass);


--
-- TOC entry 4834 (class 2604 OID 16465)
-- Name: application application_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application ALTER COLUMN application_id SET DEFAULT nextval('public.application_application_id_seq'::regclass);


--
-- TOC entry 4842 (class 2604 OID 16498)
-- Name: causedetail cause_detail_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedetail ALTER COLUMN cause_detail_id SET DEFAULT nextval('public.causedetail_cause_detail_id_seq'::regclass);


--
-- TOC entry 4839 (class 2604 OID 16489)
-- Name: causedisability cause_disability_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedisability ALTER COLUMN cause_disability_id SET DEFAULT nextval('public.causedisability_cause_disability_id_seq'::regclass);


--
-- TOC entry 4851 (class 2604 OID 16553)
-- Name: certification certification_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certification ALTER COLUMN certification_id SET DEFAULT nextval('public.certification_certification_id_seq'::regclass);


--
-- TOC entry 4845 (class 2604 OID 16512)
-- Name: disability disability_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability ALTER COLUMN disability_id SET DEFAULT nextval('public.disability_disability_id_seq'::regclass);


--
-- TOC entry 4863 (class 2604 OID 16646)
-- Name: documentrequirements document_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentrequirements ALTER COLUMN document_id SET DEFAULT nextval('public.documentrequirements_document_id_seq'::regclass);


--
-- TOC entry 4860 (class 2604 OID 16630)
-- Name: emergencycontact emergency_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact ALTER COLUMN emergency_id SET DEFAULT nextval('public.emergencycontact_emergency_id_seq'::regclass);


--
-- TOC entry 4854 (class 2604 OID 16569)
-- Name: familybackground family_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground ALTER COLUMN family_id SET DEFAULT nextval('public.familybackground_family_id_seq'::regclass);


--
-- TOC entry 4828 (class 2604 OID 16398)
-- Name: user_account user_id; Type: DEFAULT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account ALTER COLUMN user_id SET DEFAULT nextval('public.user_account_user_id_seq'::regclass);


--
-- TOC entry 5073 (class 0 OID 16536)
-- Dependencies: 231
-- Data for Name: accomplishedby; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.accomplishedby (accomplishment_id, application_id, accomplished_by, last_name, first_name, middle_name, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5079 (class 0 OID 16608)
-- Dependencies: 237
-- Data for Name: affiliation; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.affiliation (affiliation_id, applicant_id, educational_attainment, employment_status, employment_category, occupation, type_of_employment, organization_affiliated, contact_person, office_address, tel_no, sss_no, gsis_no, pagibig_no, psn_no, philhealth_no, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5063 (class 0 OID 16436)
-- Dependencies: 221
-- Data for Name: applicant; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.applicant (applicant_id, pwd_number, last_name, first_name, middle_name, suffix, birthdate, sex, civil_status, house_no_street, barangay, municipality, province, region, landline_no, mobile_no, email_address, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5065 (class 0 OID 16462)
-- Dependencies: 223
-- Data for Name: application; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.application (application_id, applicant_id, application_type, application_date, status, remarks, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5069 (class 0 OID 16495)
-- Dependencies: 227
-- Data for Name: causedetail; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.causedetail (cause_detail_id, cause_disability_id, cause_detail, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5067 (class 0 OID 16486)
-- Dependencies: 225
-- Data for Name: causedisability; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.causedisability (cause_disability_id, cause_disability, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5075 (class 0 OID 16550)
-- Dependencies: 233
-- Data for Name: certification; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.certification (certification_id, application_id, certifying_physician, license_no, processing_officer, approving_officer, encoder, reporting_unit, control_no, created_at, updated_at, pwd_cert_path) FROM stdin;
\.


--
-- TOC entry 5071 (class 0 OID 16509)
-- Dependencies: 229
-- Data for Name: disability; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.disability (disability_id, application_id, cause_detail_id, disability_type, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5083 (class 0 OID 16643)
-- Dependencies: 241
-- Data for Name: documentrequirements; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.documentrequirements (document_id, application_id, bodypic_path, pic_1x1_path, medicalcert_path, barangaycert_path, old_pwd_id_path, affidavit_loss_path, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5081 (class 0 OID 16627)
-- Dependencies: 239
-- Data for Name: emergencycontact; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.emergencycontact (emergency_id, applicant_id, contact_person_name, contact_person_no, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5077 (class 0 OID 16566)
-- Dependencies: 235
-- Data for Name: familybackground; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.familybackground (family_id, applicant_id, father_last_name, father_first_name, father_middle_name, mother_last_name, mother_first_name, mother_middle_name, guardian_last_name, guardian_first_name, guardian_middle_name, created_at, updated_at) FROM stdin;
\.


--
-- TOC entry 5061 (class 0 OID 16395)
-- Dependencies: 219
-- Data for Name: user_account; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_account (user_id, applicant_id, email, password_hash, created_at, updated_at, first_name, last_name) FROM stdin;
8	\N	thea.ancog@g.msuiit.edu.ph	$2y$10$H3bXkZi32ujilnEG.ctcbO4BrXsu6swNHQ6RXsNfLg1S5flEm4m46	2025-07-14 15:25:42.094503	2025-07-14 15:25:42.094503	Thea	Ancog
9	\N	vanbautista@gmail.com	$2y$10$fDIynEPL8ypPSBCRvj3vqOGAsaokObBb8FiCjVzWmbzb9ogyufv8.	2025-07-14 20:44:05.745059	2025-07-14 20:44:05.745059	Van	Bautista
\.


--
-- TOC entry 5059 (class 0 OID 16387)
-- Dependencies: 217
-- Data for Name: user_admin; Type: TABLE DATA; Schema: public; Owner: postgres
--

COPY public.user_admin (username, password) FROM stdin;
adminpdao	$adminpass
admin	admin123
\.


--
-- TOC entry 5102 (class 0 OID 0)
-- Dependencies: 230
-- Name: accomplishedby_accomplishment_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.accomplishedby_accomplishment_id_seq', 1, false);


--
-- TOC entry 5103 (class 0 OID 0)
-- Dependencies: 236
-- Name: affiliation_affiliation_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.affiliation_affiliation_id_seq', 1, false);


--
-- TOC entry 5104 (class 0 OID 0)
-- Dependencies: 220
-- Name: applicant_applicant_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.applicant_applicant_id_seq', 1, false);


--
-- TOC entry 5105 (class 0 OID 0)
-- Dependencies: 222
-- Name: application_application_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.application_application_id_seq', 1, false);


--
-- TOC entry 5106 (class 0 OID 0)
-- Dependencies: 226
-- Name: causedetail_cause_detail_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.causedetail_cause_detail_id_seq', 1, false);


--
-- TOC entry 5107 (class 0 OID 0)
-- Dependencies: 224
-- Name: causedisability_cause_disability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.causedisability_cause_disability_id_seq', 1, false);


--
-- TOC entry 5108 (class 0 OID 0)
-- Dependencies: 232
-- Name: certification_certification_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.certification_certification_id_seq', 1, false);


--
-- TOC entry 5109 (class 0 OID 0)
-- Dependencies: 228
-- Name: disability_disability_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.disability_disability_id_seq', 1, false);


--
-- TOC entry 5110 (class 0 OID 0)
-- Dependencies: 240
-- Name: documentrequirements_document_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.documentrequirements_document_id_seq', 1, false);


--
-- TOC entry 5111 (class 0 OID 0)
-- Dependencies: 238
-- Name: emergencycontact_emergency_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.emergencycontact_emergency_id_seq', 1, false);


--
-- TOC entry 5112 (class 0 OID 0)
-- Dependencies: 234
-- Name: familybackground_family_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.familybackground_family_id_seq', 1, false);


--
-- TOC entry 5113 (class 0 OID 0)
-- Dependencies: 218
-- Name: user_account_user_id_seq; Type: SEQUENCE SET; Schema: public; Owner: postgres
--

SELECT pg_catalog.setval('public.user_account_user_id_seq', 9, true);


--
-- TOC entry 4887 (class 2606 OID 16543)
-- Name: accomplishedby accomplishedby_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accomplishedby
    ADD CONSTRAINT accomplishedby_pkey PRIMARY KEY (accomplishment_id);


--
-- TOC entry 4895 (class 2606 OID 16617)
-- Name: affiliation affiliation_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation
    ADD CONSTRAINT affiliation_pkey PRIMARY KEY (affiliation_id);


--
-- TOC entry 4877 (class 2606 OID 16445)
-- Name: applicant applicant_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.applicant
    ADD CONSTRAINT applicant_pkey PRIMARY KEY (applicant_id);


--
-- TOC entry 4879 (class 2606 OID 16473)
-- Name: application application_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT application_pkey PRIMARY KEY (application_id);


--
-- TOC entry 4883 (class 2606 OID 16502)
-- Name: causedetail causedetail_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedetail
    ADD CONSTRAINT causedetail_pkey PRIMARY KEY (cause_detail_id);


--
-- TOC entry 4881 (class 2606 OID 16493)
-- Name: causedisability causedisability_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedisability
    ADD CONSTRAINT causedisability_pkey PRIMARY KEY (cause_disability_id);


--
-- TOC entry 4889 (class 2606 OID 16559)
-- Name: certification certification_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certification
    ADD CONSTRAINT certification_pkey PRIMARY KEY (certification_id);


--
-- TOC entry 4885 (class 2606 OID 16516)
-- Name: disability disability_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability
    ADD CONSTRAINT disability_pkey PRIMARY KEY (disability_id);


--
-- TOC entry 4903 (class 2606 OID 16652)
-- Name: documentrequirements documentrequirements_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentrequirements
    ADD CONSTRAINT documentrequirements_pkey PRIMARY KEY (document_id);


--
-- TOC entry 4899 (class 2606 OID 16634)
-- Name: emergencycontact emergencycontact_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact
    ADD CONSTRAINT emergencycontact_pkey PRIMARY KEY (emergency_id);


--
-- TOC entry 4891 (class 2606 OID 16573)
-- Name: familybackground familybackground_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground
    ADD CONSTRAINT familybackground_pkey PRIMARY KEY (family_id);


--
-- TOC entry 4897 (class 2606 OID 16625)
-- Name: affiliation unique_affiliation_applicant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation
    ADD CONSTRAINT unique_affiliation_applicant UNIQUE (applicant_id);


--
-- TOC entry 4869 (class 2606 OID 16659)
-- Name: user_account unique_email; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT unique_email UNIQUE (email);


--
-- TOC entry 4901 (class 2606 OID 16641)
-- Name: emergencycontact unique_emergencycontact_applicant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact
    ADD CONSTRAINT unique_emergencycontact_applicant UNIQUE (applicant_id);


--
-- TOC entry 4893 (class 2606 OID 16580)
-- Name: familybackground unique_familybackground_applicant; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground
    ADD CONSTRAINT unique_familybackground_applicant UNIQUE (applicant_id);


--
-- TOC entry 4871 (class 2606 OID 16406)
-- Name: user_account user_account_applicant_id_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_applicant_id_key UNIQUE (applicant_id);


--
-- TOC entry 4873 (class 2606 OID 16408)
-- Name: user_account user_account_email_key; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_email_key UNIQUE (email);


--
-- TOC entry 4875 (class 2606 OID 16404)
-- Name: user_account user_account_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_account
    ADD CONSTRAINT user_account_pkey PRIMARY KEY (user_id);


--
-- TOC entry 4867 (class 2606 OID 16393)
-- Name: user_admin user_admin_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.user_admin
    ADD CONSTRAINT user_admin_pkey PRIMARY KEY (username);


--
-- TOC entry 4908 (class 2606 OID 16544)
-- Name: accomplishedby accomplishedby_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.accomplishedby
    ADD CONSTRAINT accomplishedby_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4911 (class 2606 OID 16618)
-- Name: affiliation affiliation_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.affiliation
    ADD CONSTRAINT affiliation_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4904 (class 2606 OID 16474)
-- Name: application application_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.application
    ADD CONSTRAINT application_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4905 (class 2606 OID 16503)
-- Name: causedetail causedetail_cause_disability_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.causedetail
    ADD CONSTRAINT causedetail_cause_disability_id_fkey FOREIGN KEY (cause_disability_id) REFERENCES public.causedisability(cause_disability_id) ON DELETE SET NULL;


--
-- TOC entry 4909 (class 2606 OID 16560)
-- Name: certification certification_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.certification
    ADD CONSTRAINT certification_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4906 (class 2606 OID 16517)
-- Name: disability disability_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability
    ADD CONSTRAINT disability_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4907 (class 2606 OID 16522)
-- Name: disability disability_cause_detail_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.disability
    ADD CONSTRAINT disability_cause_detail_id_fkey FOREIGN KEY (cause_detail_id) REFERENCES public.causedetail(cause_detail_id) ON DELETE SET NULL;


--
-- TOC entry 4913 (class 2606 OID 16653)
-- Name: documentrequirements documentrequirements_application_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.documentrequirements
    ADD CONSTRAINT documentrequirements_application_id_fkey FOREIGN KEY (application_id) REFERENCES public.application(application_id) ON DELETE CASCADE;


--
-- TOC entry 4912 (class 2606 OID 16635)
-- Name: emergencycontact emergencycontact_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.emergencycontact
    ADD CONSTRAINT emergencycontact_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


--
-- TOC entry 4910 (class 2606 OID 16574)
-- Name: familybackground familybackground_applicant_id_fkey; Type: FK CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.familybackground
    ADD CONSTRAINT familybackground_applicant_id_fkey FOREIGN KEY (applicant_id) REFERENCES public.applicant(applicant_id) ON DELETE CASCADE;


-- Completed on 2025-07-21 22:27:58

--
-- PostgreSQL database dump complete
--

