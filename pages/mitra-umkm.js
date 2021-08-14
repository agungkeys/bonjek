import React from 'react';
import SEO from 'constants/seo';
import MainHead from '@components/head/MainHead';
import MainLayout from 'layout/MainLayout';
import Banners from '@components/banners/Banners';
import LandingCategory from '@components/section/LandingCategory';
import IconCatFood from '@components/icon/IconCatFood';
import IconCatCourier from '@components/icon/IconCatCourier';

import { getList } from '../helpers/fetch';
import ENV from 'constants/env';

function MitraUmkm(props) {
  const { storeBanners } = props;

  return (
    <MainLayout isHeader isFooter>      
      <MainHead seo={SEO.DEFAULT} />
      <div className="p-8">
       <span className="text-lg font-bold">Mitra UMKM</span>
      </div>
    </MainLayout>
  )
}

export async function getServerSideProps() {
  // Get the show list banners
  const storeBanners = await getList('banners');
  return { props: { storeBanners } };
}

export default MitraUmkm;