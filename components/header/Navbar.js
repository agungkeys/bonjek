/* eslint-disable @next/next/no-html-link-for-pages */
import React, { useState } from "react";
import { BiShoppingBag,  BiCycling, BiWinkSmile, BiEnvelope} from "react-icons/bi";
export default function Navbar(props) {
  const {q, filter, queryParams} = props;
  const [isMenuOpen, setIsMenuOpen] = useState(false);

  return (
    <div className="sticky top-0 z-20 py-2 bg-gradient-to-r from-pink-primary to-pink-accent-400 font-body">
      <div className="relative max-w-8xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div className="px-4 py-2 mx-auto sm:max-w-xl md:max-w-full lg:max-w-screen-xl md:px-24 lg:px-8">
          <div className="relative flex grid items-center grid-cols-2 lg:grid-cols-3">
            <ul className="flex items-center hidden space-x-8 lg:flex">
              <li>
                <a
                  href='/'
                  aria-label='Our product'
                  title='Our product'
                  className="font-bold tracking-wide text-white transition-colors duration-200 hover:text-blue-gray-100 inline-flex items-center"
                >
                  <div className="text-xl mr-1">
                    <BiShoppingBag />
                  </div>
                  UMKM
                </a>
              </li>
              <li>
                <a
                  href='/'
                  aria-label='Our product'
                  title='Our product'
                  className="font-bold tracking-wide text-white transition-colors duration-200 hover:text-blue-gray-100 inline-flex items-center"
                >
                  <div className="text-xl mr-1">
                    <BiCycling />
                  </div>
                  Kurir
                </a>
              </li>
              <li>
                <a
                  href='/'
                  aria-label='Product pricing'
                  title='Product pricing'
                  className="font-bold tracking-wide text-white transition-colors duration-200 hover:text-blue-gray-100 inline-flex items-center"
                >
                  <div className="text-xl mr-1">
                    <BiWinkSmile />
                  </div>
                  Tentang&nbsp;Bonjek
                </a>
              </li>
            </ul>
            <a
              href='/'
              aria-label='Company'
              title='Company'
              className="inline-flex items-center lg:mx-auto"
            >
              <svg className="w-8" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                <circle className="cls-1" fill="#fff" cx="256.23" cy="256" r="256" />
                <path className="cls-2" fill="#fff24b" d="M256.59,119.24l-.73,0Z" />
                <path className="cls-3" fill="#a84291" d="M256.23,163.82v.11a27.36,27.36,0,0,0-17.93,6.77L236,173a27.51,27.51,0,0,0,20.34,45.94h-.07a37.81,37.81,0,1,1-37.81,37.8c0-.39,0-.77,0-1.16V171.82l0,0V58.66h0a27.54,27.54,0,0,0-45.65-20.29c-.79.76-1.57,1.53-2.35,2.3a27.46,27.46,0,0,0-7.11,18.47c0,.13,0,.26,0,.39h0V257h0a92.93,92.93,0,1,0,92.92-93.14Z" />
                <path className="cls-4" fill="#d92f8a" d="M256.23,54c-2.15,0-4.28,0-6.41.11v0a27.29,27.29,0,0,0-18,6.74c-.78.76-1.56,1.52-2.33,2.29a27.37,27.37,0,0,0,20.31,45.7c.34,0,.68,0,1,0l.73,0h.09c1.52,0,3-.09,4.58-.09a148.14,148.14,0,1,1-105.26,44,27.36,27.36,0,0,0-36.26-41c-.79.76-1.56,1.52-2.33,2.29l-.17.19c.31-.39.63-.77,1-1.14A202.11,202.11,0,0,0,53.44,256.74c0,112,90.79,202.79,202.79,202.79S459,368.74,459,256.74,368.22,54,256.23,54Z" />
              </svg>
              <span className="ml-2 text-2xl font-bold tracking-wide text-white">
                bonjek
              </span>
            </a>
            <ul className="flex items-center hidden ml-auto space-x-8 lg:flex">
              <li>
                <a
                  href='/'
                  aria-label='Sign in'
                  title='Sign in'
                  className="font-bold tracking-wide text-white transition-colors duration-200 hover:text-blue-gray-100 inline-flex items-center"
                >
                  <div className="text-xl mr-1">
                    <BiEnvelope />
                  </div>
                  Masukan &amp; Saran
                </a>
              </li>
              <li>
                <a
                  href='/'
                  className="inline-flex items-center justify-center h-10 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-purple-primary hover:bg-purple-900 focus:shadow-outline focus:outline-none"
                  aria-label='Sign up'
                  title='Sign up'
                >
                  Bantuan
                </a>
              </li>
            </ul>
            <div className="ml-auto lg:hidden">
              <button
                aria-label='Open Menu'
                title='Open Menu'
                className="p-2 -mr-1 transition duration-200 rounded focus:outline-none hover:bg-pink-100"
                onClick={() => setIsMenuOpen(true)}
              >
                <svg className="w-5 text-white" viewBox="0 0 24 24">
                  <path
                    fill="#fff"
                    d="M23,13H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,13,23,13z"
                  />
                  <path
                    fill="#fff"
                    d="M23,6H1C0.4,6,0,5.6,0,5s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,6,23,6z"
                  />
                  <path
                    fill="#fff"
                    d="M23,20H1c-0.6,0-1-0.4-1-1s0.4-1,1-1h22c0.6,0,1,0.4,1,1S23.6,20,23,20z"
                  />
                </svg>
              </button>
              {isMenuOpen && (
                <div className="absolute top-0 left-0 w-full z-10">
                  <div className="p-5 bg-white border rounded shadow-sm">
                    <div className="flex items-center justify-between mb-4">
                      <div>
                        <a
                          href='/'
                          aria-label='Company'
                          title='Company'
                          className="inline-flex items-center"
                        >
                          <svg className="w-8" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                            <circle className="cls-1" fill="#fff" cx="256.23" cy="256" r="256" />
                            <path className="cls-2" fill="#fff24b" d="M256.59,119.24l-.73,0Z" />
                            <path className="cls-3" fill="#a84291" d="M256.23,163.82v.11a27.36,27.36,0,0,0-17.93,6.77L236,173a27.51,27.51,0,0,0,20.34,45.94h-.07a37.81,37.81,0,1,1-37.81,37.8c0-.39,0-.77,0-1.16V171.82l0,0V58.66h0a27.54,27.54,0,0,0-45.65-20.29c-.79.76-1.57,1.53-2.35,2.3a27.46,27.46,0,0,0-7.11,18.47c0,.13,0,.26,0,.39h0V257h0a92.93,92.93,0,1,0,92.92-93.14Z" />
                            <path className="cls-4" fill="#d92f8a" d="M256.23,54c-2.15,0-4.28,0-6.41.11v0a27.29,27.29,0,0,0-18,6.74c-.78.76-1.56,1.52-2.33,2.29a27.37,27.37,0,0,0,20.31,45.7c.34,0,.68,0,1,0l.73,0h.09c1.52,0,3-.09,4.58-.09a148.14,148.14,0,1,1-105.26,44,27.36,27.36,0,0,0-36.26-41c-.79.76-1.56,1.52-2.33,2.29l-.17.19c.31-.39.63-.77,1-1.14A202.11,202.11,0,0,0,53.44,256.74c0,112,90.79,202.79,202.79,202.79S459,368.74,459,256.74,368.22,54,256.23,54Z" />
                          </svg>
                          <span className="ml-2 text-xl font-bold tracking-wide text-gray-800">
                            bonjek
                          </span>
                        </a>
                      </div>
                      <div>
                        <button
                          aria-label='Close Menu'
                          title='Close Menu'
                          className="p-2 -mt-2 -mr-2 transition duration-200 rounded hover:bg-gray-200 focus:bg-gray-200 focus:outline-none"
                          onClick={() => setIsMenuOpen(false)}
                        >
                          <svg className="w-5 text-gray-600" viewBox="0 0 24 24">
                            <path
                              fill="currentColor"
                              d="M19.7,4.3c-0.4-0.4-1-0.4-1.4,0L12,10.6L5.7,4.3c-0.4-0.4-1-0.4-1.4,0s-0.4,1,0,1.4l6.3,6.3l-6.3,6.3 c-0.4,0.4-0.4,1,0,1.4C4.5,19.9,4.7,20,5,20s0.5-0.1,0.7-0.3l6.3-6.3l6.3,6.3c0.2,0.2,0.5,0.3,0.7,0.3s0.5-0.1,0.7-0.3 c0.4-0.4,0.4-1,0-1.4L13.4,12l6.3-6.3C20.1,5.3,20.1,4.7,19.7,4.3z"
                            />
                          </svg>
                        </button>
                      </div>
                    </div>
                    <nav>
                      <ul className="space-y-4">
                        <li>
                          <a
                            href='/'
                            aria-label='UMKM'
                            title='UMKM'
                            className="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-deep-purple-accent-400"
                          >
                            Mitra UMKM
                          </a>
                        </li>
                        <li>
                          <a
                            href='/'
                            aria-label='Kurir'
                            title='Kurir'
                            className="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-deep-purple-accent-400"
                          >
                            Mitra Kurir
                          </a>
                        </li>
                        <li>
                          <a
                            href='/'
                            aria-label='Tentang Bonjek'
                            title='Tentang Bonjek'
                            className="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-deep-purple-accent-400"
                          >
                            Tentang Bonjek
                          </a>
                        </li>
                        <li>
                          <a
                            href='/'
                            aria-label='Masukan &amp; Saran'
                            title='Masukan &amp; Saran'
                            className="font-medium tracking-wide text-gray-700 transition-colors duration-200 hover:text-deep-purple-accent-400"
                          >
                            Masukan &amp; Saran
                          </a>
                        </li>
                        <li>
                          <a
                            href='/'
                            className="inline-flex items-center justify-center w-full h-12 px-6 font-medium tracking-wide text-white transition duration-200 rounded shadow-md bg-deep-purple-accent-400 hover:bg-deep-purple-accent-700 focus:shadow-outline focus:outline-none"
                            aria-label='Bantuan'
                            title='Bantuan'
                          >
                            Bantuan
                          </a>
                        </li>
                      </ul>
                    </nav>
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>

      </div>

      
    </div>
  );
};