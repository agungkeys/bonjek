import React from 'react';
import MainHeader from '@components/header/MainHeader';
import MainFooter from '@components/footer/MainFooter';

function MainLayout(props){
  const { children } = props;
  return(
    <>
      <MainHeader />
      <>{children}</>
      <MainFooter />
    </>
  )
}

export default MainLayout;
