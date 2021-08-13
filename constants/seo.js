import getConfig from 'next/config';
const { publicRuntimeConfig } = getConfig();

const SEO = {
  DEFAULT: {
    TITLE: 'Bonjek | Ojek Online Bontang',
    DESC:
      'Bonjek adalah aplikasi ojek online karya anak bontang, kurir kami siap melayani kebutuhan harian anda',
    KEYWORDS:
      'bonjek, bontang ojek, ojek umkm, ojek online, delivery courier',
    AUTHOR: 'Bonjek - Karya Anak Bontang',
    CANONICAL_URL: `${publicRuntimeConfig.HOST}`,
    OG_LOCALE: 'Id_ID',
    OG_TITLE: 'Bonjek | Ojek Online Bontang',
    OG_DESC:
      'Bonjek adalah aplikasi ojek online karya anak bontang, kurir kami siap melayani kebutuhan harian anda',
    OG_TYPE: 'website',
    OG_SITENAME: 'Bonjek',
    OG_URL: publicRuntimeConfig.HOST,
    OG_IMAGE:
      'https://res.cloudinary.com/dsxlujoww/image/upload/v1628741405/bonjek_84c7ea5d2e.svg',
    OG_IMAGE_URL:
      'https://res.cloudinary.com/dsxlujoww/image/upload/v1628741405/bonjek_84c7ea5d2e.svg',
    OG_IMAGE_TYPE: 'jpg',
    OG_IMAGE_WIDTH: '1200',
    OG_IMAGE_HEIGHT: '628',
    OG_IMAGE_ALT: 'Bonjek sebagai teman kurir anda',
    OG_TWITTER_CARD: 'Summary',
    OG_TWITTER_TITLE: 'Bonjek | Ojek Online Bontang',
    OG_TWITTER_DESC:
      'Bonjek adalah aplikasi ojek online karya anak bontang, kurir kami siap melayani kebutuhan harian anda',
    OG_TWITTER_SITE: '@bonjekid',
  },
};

export default SEO;