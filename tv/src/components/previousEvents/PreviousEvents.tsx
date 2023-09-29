import React, { useState, useEffect } from "react";
import "./previousevents.css";

export default function PreviousEvents() {
  const accordionItems = [
    {
      title: "Providing technology support to the Ministry of Health - Central Province",
      content: "Providing technology support for the Ministry of Health to improve computer network & the Internet facilities at the Ministry of Health- Central province."
    },
    {
      title: "Website for Department of Ophthalmology (Center for Sight), Teaching Hospital, Kandy",
      content: "The IT Center designed and launched a web site for the Department of Ophthalmology (Center for Sight), Teaching Hospital, Kandy. This activity was carried out as a social service of the Center in 2009."
    },
    {
      title: "Gynecology and obstetrics patient information analysis system",
      content: "The IT Center developed a database management system to facilitate collection and analysis of data with regard to the Gynecology and obstetrics patients admitted to the Gyn & Obs ward in the Teaching Hospital, Peradeniya. The main information handled by this system have been carefully designed based on the request of Medical Practitioners, to meet their needs to draw timely conclusions on best management practices."
    },
    {
      title: "IT Center organizes a free workshop for GCE (O/L) students in and around Kandy",
      content:  "The IT Center of the University organized a one day workshop on ICT named “Thorathuru Thaakshanaya Thulin Lowa Dinamu” for the students sitting for the IT subject in the GCE (O/L) examination this December. A limited number of students from about 20 schools, together with their teachers, amounting to a total of 120 had been invited for this event which was held on November 18th at the IT Center of the University. The Center has received financial and material support from several organizations towards this activity, and the staff thanks all those who pledged their support."
    },
    {
      title: "Technology support for the “Sri Lanka Police Service” and the “Ministry of Justice and Law Reforms” for crime detect",
      content: "The IT Center is happy to be a technology resource base for government organizations like the Police Department and the Judicial system in several occasions. It is widely accepted that computer and ICT related crime detection and proof is only possible with the involvement of technical expertise in ICT. The IT Center has provided technical support to these organizations in the past, to help them identify criminals with existing evidence, and also to ascertain whether a crime has been committed."
    }
  ];

  const [openAccordion, setOpenAccordion] = useState<number>(0); // Change null to 0

  const toggleAccordion = (index: number) => {
    setOpenAccordion(index);
  };

  useEffect(() => {
    const autoToggleAccordion = () => {
      const nextIndex = (openAccordion + 1) % accordionItems.length;
      setOpenAccordion(nextIndex);
    };

    const intervalId = setInterval(autoToggleAccordion, 10000); // Change to 10000 milliseconds (10 seconds)

    return () => clearInterval(intervalId);
  }, [openAccordion, accordionItems.length]);

  return (
    <div className="accordion">
      <h1 className="header">Services done by IT Center</h1>
      {accordionItems.map((item, index) => (
        <div className="accordion-item" key={index}>
          <div
            className="accordion-header"
            onClick={() => toggleAccordion(index)}
          >
            <span className={`accordion-title ${openAccordion === index ? "open" : ""}`}>
              {item.title}
            </span>
            <span className={`icon ${openAccordion === index ? "open" : ""}`}>+</span>
          </div>
          <div className={`accordion-content ${openAccordion === index ? "active" : ""}`}>
            {item.content}
          </div>
        </div>
      ))}
    </div>
  );
}
