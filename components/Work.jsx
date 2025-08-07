import { assets, workData } from '@/assets/assets'
import Image from 'next/image'
import React from 'react'
import { motion } from "motion/react"

const Work = () => {
    return (
        <motion.div initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 1 }} id='works' className='w-full flex flex-col justify-center md:px-[12%] px-4 py-10 scroll-mt-20'>
            <motion.h4 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.3 }} className='text-center mb-2 text-lg font-Ovo'>
                My Portfolio
            </motion.h4>
            <motion.h2 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.5 }} className='text-center text-5xl font-Ovo'>My Latest Work</motion.h2>
            <motion.p initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 0.5, delay: 0.7 }} className='text-center max-w-2xl mx-auto mt-5 mb-12 font-Ovo'>I actively work on personal projects including web development, Android app creation, and UI design—focusing on performance, usability, and clean interfaces. I also explore ethical hacking and secure coding to strengthen my cybersecurity skills. Each project reflects my passion for building modern, secure, and user-focused digital solutions. </motion.p>

            <motion.div initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 0.6, delay: 0.9 }} className='grid grid-template-cols-auto gap-5 my-10'>
                {workData.map((project, index) => (
                    <motion.a target='_blank' href={project.link} whileHover={{ scale: 1.05 }} transition={{duration: 0.3}} key={index} style={{ backgroundImage: `url(${project.bgImage})` }} className='aspect-square bg-no-repeat bg-cover bg-center rounded-lg relative cursor-pointer group border border-gray-200'>
                        <div className='bg-white w-10/12 rounded-md absolute bottom-5 left-1/2 -translate-x-1/2 py-3 px-5 flex items-center justify-between duration-500 group-hover:bottom-7 border border-gray-200'>
                            <div className=''>
                                <h2 className='font-semibold line-clamp-1'>{project.title}</h2>
                                <p className='text-sm text-gray-700 line-clamp-1'>{project.description}</p>
                            </div>
                            <div className='border rounded-full border-black w-9 aspect-square flex items-center justify-center shadow-[2px_2px_0_#000] group-hover:bg-lime-300 transition'>
                                <Image src={assets.send_icon} alt='' className='w-5' />
                            </div>
                        </div>
                    </motion.a>
                ))}
            </motion.div>

            <motion.a  initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 0.5, delay: 0.6 }} href="" className='w-max flex items-center justify-center gap-2 text-gray-700 border border-gray-700 rounded-full py-3 px-10 mx-auto my-20 hover:bg-light-hover duration-500'>
                Show more <Image src={assets.right_arrow_bold} alt='' className='w-4' />
            </motion.a>
        </motion.div>
    )
}

export default Work