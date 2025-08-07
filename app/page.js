"use client";

import Navbar from "@/components/Navbar";
import Header from "../components/Header";
import About from "../components/About";
import Services from "../components/Services";
import Work from "../components/Work";
import Contact from "../components/Contact";
import Footer from "../components/Footer";
import Clients from "../components/Client";

export default function Home() {
  return (
    <div className="">
      <Navbar/>
      <Header/>
      <About/>
      <Services/>
      <Clients/>
      <Work/>
      <Contact/>
      <Footer/>
    </div>
  );
}
