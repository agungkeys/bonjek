import Head from 'next/head';
import SEO from 'constants/seo';


export default function Home() {
  return (
    <div className="container">
      <Head>
        <title>Next.js Starter!</title>
        <link rel="icon" href="/favicon.ico" />
      </Head>
      
      {console.log("🚀 ~ file: index.js ~ line 3 ~ SEO", SEO)}
      <main>
        <p className="description">
          Get started by editing <code>pages/index.js</code>
        </p>
      </main>

    </div>
  )
}