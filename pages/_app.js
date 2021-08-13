import '@styles/globals.css';
import '@styles/banners.css';
import "slick-carousel/slick/slick.css";
import "slick-carousel/slick/slick-theme.css";

import MainLayout from "layout/MainLayout"

function Application({ Component, pageProps }) {
  return (
    <MainLayout>
      <Component {...pageProps} />
    </MainLayout>
  )
}

export default Application
