import { assets, serviceData } from '@/assets/assets'
import Image from 'next/image'
import React from 'react'
import { motion } from "motion/react"

const Services = () => {
    return (
        <motion.div initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 1 }} id='services' className='w-full flex flex-col justify-center md:px-[12%] px-4 py-10 scroll-mt-20'>
            <motion.h4 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.3 }} className='text-center mb-2 text-lg font-Ovo'>
                What I Offer
            </motion.h4>
            <motion.h2 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.5 }} className='text-center text-5xl font-Ovo'>My Services</motion.h2>
            <motion.p initial={{ opacity: 0 }} whileInView={{ opacity: 1}} transition={{ direction: 0.5, delay: 0.7 }} className='text-center max-w-2xl mx-auto mt-5 mb-12 font-Ovo'>I offer modern web and Android app development with a focus on speed, scalability, and great user experience. I design clean, user-friendly interfaces and ensure applications are secure through. As a freelance developer, I deliver end-to-end solutions tailored to client needs. </motion.p>

            <motion.div initial={{opacity:0}} whileInView={{opacity:1}} transition={{direction:0.6, delay:0.9}} className='grid grid-template-cols-auto gap-6 my-10'>
                {serviceData.map(({ icon, title, description, link }, index) => (
                    <motion.div whileHover={{scale: 1.05}} key={index} className='border border-gray-400 rounded-lg px-8 py-12 hover-shadow-black cursor-pointer hover:bg-light-hover hover:-translate-y-1 duration-500'>
                        <Image src={icon} alt='' className='w-10' />
                        <h3 className='text-lg my-4 text-gray-700'>{title}</h3>
                        <p className='text-sm text-gray-600 leading-5'>{description}</p>
                        <a href={link} className='flex items-center gap-2 text-sm mt-5 '>Read more <Image src={assets.right_arrow} alt=''/></a>
                    </motion.div>
                ))}
            </motion.div>
        </motion.div>
    )
}

export default Services