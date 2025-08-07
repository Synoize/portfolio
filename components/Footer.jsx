import { assets } from '@/assets/assets'
import Image from 'next/image'
import React from 'react'

const Footer = () => {
    return (
        <div className='mt-20'>
            <div className='text-center'>
                <Image src={assets.logo} alt='' className='w-36 mx-auto mb-2'/>
                <a target='_blank' href='synoize@gmail.com' className='w-max flex items-center gap-2 mx-auto hover:underline'>
                    <Image src={assets.mail_icon} alt='' className='w-6'/>
                    synoize@gmail.com
                </a>
            </div>
            <div className='text-center sm:flex items-center justify-between border-t border-gray-400 mx-[10%] mt-12 py-6'>
                <p>© {new Date().getFullYear()} Shivam Singh. All rights reserved.</p>
                <ul className='flex items-center gap-4 md:gap-10 justify-center mt-4 sm:mt-0 '>
                    <li><a target='_blank' href="https://www.instagram.com/synoize">Instagram</a></li>
                    <li><a target='_blank' href="https://www.githb.com/synoize">GitHub</a></li>
                    <li><a target='_blank' href="https://www.linkedin.com/in/synoize">LinkedIn</a></li>
                    <li><a target='_blank' href="https://www.x.com/synoize">Twitter</a></li>
                </ul>
            </div>
            
        </div>
    )
}

export default Footer