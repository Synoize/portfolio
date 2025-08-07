import { assets, infoList, toolsData } from '@/assets/assets'
import Image from 'next/image'
import React from 'react'
import { motion } from "motion/react"

const About = () => {
    return (
        <motion.div initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 1 }} id='about' className='w-full flex flex-col justify-center py-10 scroll-mt-20'>
            <motion.h4 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.3 }} className='text-center mb-2 text-lg font-Ovo'>
                Introduction
            </motion.h4>
            <motion.h2 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.5 }} className='text-center text-5xl font-Ovo'>About Me</motion.h2>

            <motion.div initial={{opacity:0}} whileInView={{opacity:1}} transition={{direction:0.8}}  className='flex w-full flex-col lg:flex-row items-center justify-center gap-20 my-20'>
                <motion.div initial={{opacity:0, scale:0.9}} whileInView={{opacity:1, scale:1}} transition={{direction:0.6}}  className='w-64 sm:w-80 rounded-3xl max-w-none'>
                    <Image src={assets.user_image} alt='' className='w-full rounded-3xl' />
                </motion.div>
                <motion.div initial={{opacity:0}} whileInView={{opacity:1}} transition={{direction:0.6, delay:0.8}} className='px-4'>
                    <p className='mb-10 max-w-2xl font-Ovo sm:text-start text-center'>
                        I am a passionate web & android developer, cybersecurity enthusiast, and problem solving for computer vision, dedicated to building scalable, efficient, and user-friendly applications. I thrive on creating innovative digital solutions.

                        My work extends beyond coding—I focus on delivering seamless user experiences while ensuring performance and security.

                        Driven by my passion for cybersecurity, I actively explore ethical hacking, penetration testing, and secure coding practices to build robust and secure applications. As a freelance developer, I have collaborated with clients to craft high-quality web applications and intuitive UI designs.

                        Beyond my professional work, I am constantly pushing the boundaries of innovation through my startup ideas, continuously learning, and staying ahead in the ever-evolving tech landscape.
                    </p>
                    <motion.ul initial={{opacity:0}} whileInView={{opacity:1}} transition={{direction:0.8, delay:0.5}} className='grid grid-cols-1 sm:grid-cols-3 gap-6 max-w-2xl'>
                        {infoList.map(({ icon, iconDark, title, description }, index) => (
                            <motion.li whileHover={{scale:1.05}} key={index} className=' border border-gray-400 rounded-xl p-6 cursor-pointer hover:bg-light-hover hover:translate-y-1 duration-500 hover-shadow-black '>
                                <Image src={icon} alt={title} className='w-7 mt-3 ' />
                                <h3 className='my-4 font-semibold text-gray-700'>{title}</h3>
                                <p className='text-gray-600 text-sm'>{description}</p>
                            </motion.li>
                        ))}
                    </motion.ul>

                    <motion.h4 initial={{opacity:0, y:20}} whileInView={{opacity:0.6, delay:0.8}} transition={{direction:0.5, delay:1.3}} className='my-6 text-gray-700 font-Ovo'>Tools & Frameworks I use</motion.h4>
                    <motion.ul  initial={{opacity:0}} whileInView={{opacity:1}} transition={{direction:0.8, delay:0.6}} className='flex flex-wrap items-center gap-3 sm:gap-5'>
                        {toolsData.map((tool, index) => (
                            <motion.li  whileHover={{scale:1.1}} key={index} className='flex items-center justify-center w-12 sm:w-14 aspect-square border border-gray-400 rounded-lg cursor-pointer hover:-translate-y-1 duration-500'>
                                <Image src={tool} alt='tool' className='w-5 sm:w-7' />
                            </motion.li>
                        ))}
                    </motion.ul>
                </motion.div>
            </motion.div>
        </motion.div>
    )
}

export default About