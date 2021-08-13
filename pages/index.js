import Head from 'next/head';
import { CURRENT_ENV, CURRENT_API, CURRENT_HOST} from '../constants/env';
import getConfig from 'next/config';

const getNodeEnv = () => {
  const { publicRuntimeConfig } = getConfig();
  console.log("🚀 ~ file: index.js ~ line 7 ~ getNodeEnv ~ publicRuntimeConfig", publicRuntimeConfig)

  const isProd = publicRuntimeConfig.isProd || false;
  const isStaging = publicRuntimeConfig.isStaging || false;
  const isDev = publicRuntimeConfig.isDev || false;

  return { isProd, isStaging, isDev }
};

const env = getNodeEnv()
console.log("🚀 ~ file: MainHead.js ~ line 17 ~ MainFooter ~ env", env)

export default function Home() {
  return (
    <div className="container">
      <Head>
        <title>Next.js Starter!</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>

      <main>
        <p className="description">
          Get started by editing <code>pages/index.js</code>
        </p>
      </main>

    </div>
  )
}
