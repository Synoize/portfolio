import { assets } from '@/assets/assets'
import Image from 'next/image'
import React, { useState } from 'react'

const Contact = () => {
    const [result, setResult] = useState("");
    // const WEB3FORM_ACCESS_KEY = process.env.NEXT_WEB3FORM_ACCESS_KEY

    const onSubmit = async (event) => {
        event.preventDefault();
        setResult("Sending....");
        const formData = new FormData(event.target);

        formData.append("access_key", "15b0e50f-47da-4425-b466-55b74a69b553");

        const response = await fetch("https://api.web3forms.com/submit", {
            method: "POST",
            body: formData
        });

        const data = await response.json();

        if (data.success) {
            setResult("Form Submitted Successfully");
            event.target.reset();
        } else {
            console.log("Error", data);
            setResult(data.message);
        }
    };

    return (
        <div id='contact' className='w-full flex flex-col justify-center py-10 scroll-mt-20 bg-[url("/footer-bg-color.png")] bg-no-repeat bg-center bg-[length:90%_auto] p-4'>
            <h4 className='text-center mb-2 text-lg font-Ovo'>
                Connect With Me
            </h4>
            <h2 className='text-center text-5xl font-Ovo'>Get In Touch</h2>
            <p className='text-center max-w-2xl mx-auto mt-5 mb-12 font-Ovo'>Have a project in mind or just want to connect? I'm always open to new opportunities, collaborations, or a quick chat about tech and ideas. Feel free to reach out—let’s build something great together!
            </p>

            <form onSubmit={onSubmit} className='sm:w-2xl w-full mx-auto'>
                <div className='grid grid-template-cols-auto gap-6 mt-10 mb-8'>
                    <input type="text" name='name' placeholder='Enter your name' required className='flex-1 p-3 outline-none border border-gray-400 rounded-md bg-white' />
                    <input type="email" name='email' placeholder='Enter your email' required className='flex-1 p-3 outline-none border border-gray-400 rounded-md bg-white' />
                </div>
                <textarea name="message" id="" rows={6} placeholder='Enter yor message' required className='w-full p-4 outline-none border border-gray-400 rounded-md bg-white mb-6'></textarea>

                <button type='submit' className='py-3 px-8 w-max flex items-center justify-between gap-2 bg-black/80 text-white rounded-full mx-auto hover:bg-black duration-500 cursor-pointer'>Submit now <Image src={assets.right_arrow_white} alt="" className="w-4" /></button>

                <p className='mt-4'>{result}</p>
            </form>
        </div>
    )
}

export default Contact