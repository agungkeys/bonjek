import React from 'react';
import SEO from 'constants/seo';
import MainHead from '@components/head/MainHead';
import MainLayout from 'layout/MainLayout';
import Container from '@components/section/Container';

import { getList } from '../helpers/fetch';

function MitraKurir(props) {
  const { storeBanners } = props;

  return (
    <MainLayout isHeader isFooter>      
      <MainHead seo={SEO.DEFAULT} />
      <Container>
        <div className="pt-3">
          <span className="text-lg font-bold">Mitra Kurir</span>
        </div>
      </Container>
    </MainLayout>
  )
}

export async function getServerSideProps({ req }) {
  const { context } = req.netlifyFunctionParams || {};

  if (context) {
    console.log("Setting callbackWaitsForEmptyEventLoop: false");
    context.callbackWaitsForEmptyEventLoop = false;
  }
  // Get the show data mitra-umkm
  const storeBanners = await getList('banners');
  return { props: { storeBanners } };
}

export default MitraKurir;