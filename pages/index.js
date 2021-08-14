import Head from 'next/head';
import SEO from 'constants/seo';
import MainHead from '@components/head/MainHead';
import MainLayout from 'layout/MainLayout';
import Banners from '@components/banners/Banners';
import LandingCategory from '@components/section/LandingCategory';
import IconCatFood from '@components/icon/IconCatFood';
import IconCatCourier from '@components/icon/IconCatCourier';

import { getList } from '../helpers/fetch';
import ENV from 'constants/env';

function Home(props) {
  const { storeBanners } = props;
  const menuLandingCategories = [
    {
      id: 0,
      label: 'Order',
      title: 'Makanan',
      background: 'bg-landing-category-food',
      icon: <IconCatFood />,
      link: '/umkm'
    },
    {
      id: 1,
      label: 'Order',
      title: 'Kurir',
      background: 'bg-landing-category-courier',
      icon: <IconCatCourier />,
      link: '/kurir'
    }
  ]
  return (
    <MainLayout isHeader isFooter>      
      <MainHead seo={SEO.DEFAULT} />
      <div>
        <div className="sm:p-2 md:p-4 lg:p-6">
          <Banners items={storeBanners}/>
        </div>
        <div className="relative px-4 pt-1 md:pt-2 md:py-4">
          <LandingCategory items={menuLandingCategories} />
        </div>
      </div>
    </MainLayout>
  )
}

export async function getServerSideProps() {
  // Get the show list banners
  const storeBanners = await getList('banners');
  return { props: { storeBanners } };
}

export default Home;