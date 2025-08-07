import { assets, clientData, } from '@/assets/assets'
import Image from 'next/image'
import React from 'react'
import { motion } from "motion/react"

const Clients = () => {
    return (
        <motion.div initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 1 }} className='w-full flex flex-col justify-center md:px-[12%] px-4 py-10 scroll-mt-20'>
            <motion.h4 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.3 }} className='text-center mb-2 text-lg font-Ovo'>
                What I Do
            </motion.h4>
            <motion.h2 initial={{ opacity: 0, y: -20 }} whileInView={{ opacity: 1, y: 0 }} transition={{ direction: 0.5, delay: 0.5 }} className='text-center text-5xl font-Ovo'>My Clients</motion.h2>
            <motion.p initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 0.5, delay: 0.7 }} className='text-center max-w-2xl mx-auto mt-5 mb-12 font-Ovo'>I design and develop websites and user interfaces for clients. My work focuses on clean design, smooth user experience, and responsive layouts. I also provide complete solutions using modern and reliable technologies.</motion.p>

            <motion.div initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 0.6, delay: 0.9 }} className='grid grid-template-cols-auto gap-5 my-10'>
                {clientData.map((project, index) => (
                    <motion.div whileHover={{ scale: 1.02 }} transition={{ duration: 0.3 }} key={index} style={{ backgroundImage: `url(${project.projectImage})` }} className='h-80 bg-no-repeat bg-cover bg-center rounded-lg relative cursor-pointer group'>
                        <div className='bg-white w-10/12 rounded-md absolute bottom-5 left-1/2 -translate-x-1/2 py-3 px-5 flex items-center justify-between duration-500 group-hover:bottom-7'>
                            <div className='flex gap-4 items-center'>
                                <div className='rounded-lg bg-black/80 group-hover:bg-black w-14 aspect-square flex items-center justify-center transition p-2'>
                                    <img src={project.icon} alt=""/>
                                </div>
                                <div className=''>
                                    <h2 className='font-semibold'>{project.name}</h2>
                                    <p className='text-sm text-gray-700 line-clamp-1'>{project.title}</p>
                                </div>
                            </div>
                            <a target='_blank' href={project.link} className='border rounded-full border-black w-9 aspect-square flex items-center justify-center shadow-[2px_2px_0_#000] group-hover:bg-lime-300 transition'>
                                <Image src={assets.send_icon} alt='' className='w-5' />
                            </a>
                        </div>
                    </motion.div>
                ))}
            </motion.div>

            <motion.a initial={{ opacity: 0 }} whileInView={{ opacity: 1 }} transition={{ direction: 0.5, delay: 0.6 }} href="" className='w-max flex items-center justify-center gap-2 text-gray-700 border border-gray-700 rounded-full py-3 px-10 mx-auto my-20 hover:bg-light-hover duration-500'>
                Show more <Image src={assets.right_arrow_bold} alt='' className='w-4' />
            </motion.a>
        </motion.div>
    )
}

export default Clients