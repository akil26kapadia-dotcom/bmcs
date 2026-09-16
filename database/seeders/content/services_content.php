<?php

/**
 * Per-service content, keyed by slug. Each entry supplies the unique
 * short/long description and SEO metadata that differentiate a service
 * page from its category siblings. Capabilities/benefits/applications/faq
 * are inherited from the parent category template unless overridden here.
 */

return [
    // --- Network & Infrastructure ---
    'structured-cabling' => [
        'short_description' => 'Structured cabling design and installation for reliable, future-ready office networks.',
        'description' => 'Structured cabling is the physical backbone of your network — the cabling, patch panels and containment that connect every device in your office. We design and install Cat6/Cat6a copper and fiber optic cabling systems that are neatly organized, properly labeled and built to support your current and future connectivity needs.',
        'technologies' => 'Cat6/Cat6a copper cabling, fiber optic backbone, patch panels, cable management',
        'meta_title' => 'Structured Cabling Services in Dubai',
        'meta_description' => 'Professional structured cabling design and installation in Dubai and across the UAE — Cat6/Cat6a and fiber optic solutions built for reliable, scalable office networks.',
    ],
    'wireless-infrastructure' => [
        'short_description' => 'Enterprise wireless network design for full, reliable Wi-Fi coverage across your workspace.',
        'description' => 'A poorly planned wireless network leads to dead zones, dropped connections and frustrated staff. We design and deploy enterprise-grade wireless networks with proper access point placement, secure guest networking and coverage planning suited to your office layout.',
        'technologies' => 'Enterprise Wi-Fi access points, wireless controllers, guest network segmentation',
        'meta_title' => 'Wireless Network Infrastructure in Dubai',
        'meta_description' => 'Enterprise wireless infrastructure design and installation in Dubai — full-coverage, secure Wi-Fi networks for offices of any size, delivered by BMCS.',
    ],
    'vpn-installation' => [
        'short_description' => 'Secure VPN setup for safe remote access to your business network from anywhere.',
        'description' => 'A properly configured VPN lets your team securely access company systems, files and applications from outside the office without exposing your network to unnecessary risk. We design and install VPN solutions suited to your remote and hybrid working needs.',
        'technologies' => 'Site-to-site VPN, remote-access VPN, VPN gateway configuration',
        'meta_title' => 'VPN Installation & Setup in Dubai',
        'meta_description' => 'Secure VPN installation and configuration in Dubai and the UAE, enabling safe remote access to your business network for hybrid and remote teams.',
    ],
    'network-services' => [
        'short_description' => 'Ongoing network design, configuration and troubleshooting for growing businesses.',
        'description' => 'From switch and router configuration to network audits and performance troubleshooting, our network services cover the day-to-day and project-based work needed to keep your business connectivity running smoothly as your team and requirements grow.',
        'technologies' => 'Network switching, routing, VLAN configuration, network monitoring',
        'meta_title' => 'Network Services in Dubai',
        'meta_description' => 'Network design, configuration and troubleshooting services in Dubai — BMCS keeps your business network reliable, secure and ready to scale.',
    ],

    // --- Cloud & Data ---
    'cloud-solutions' => [
        'short_description' => 'Cloud infrastructure and migration services for flexible, accessible business computing.',
        'description' => 'Moving to the cloud gives your business flexibility, remote accessibility and reduced dependence on on-site hardware. We plan and execute cloud migrations for servers, storage and business applications, tailored to your existing systems and growth plans.',
        'technologies' => 'Cloud infrastructure migration, cloud storage, virtual servers',
        'meta_title' => 'Cloud Solutions for Business in Dubai',
        'meta_description' => 'Cloud infrastructure and migration services in Dubai and the UAE — BMCS helps businesses move servers, storage and applications to the cloud securely.',
    ],
    'data-recovery-backup' => [
        'short_description' => 'Automated backup and data recovery solutions to protect your business from data loss.',
        'description' => 'Hardware failure, accidental deletion and site incidents can all result in lost business data. We implement automated, scheduled backup systems with regular restore testing, so your critical files and systems can be recovered quickly when it matters.',
        'technologies' => 'Automated backup scheduling, offsite/cloud backup, restore testing',
        'meta_title' => 'Data Recovery & Backup Solutions in Dubai',
        'meta_description' => 'Automated backup and data recovery solutions in Dubai — protect your business data from hardware failure and accidental loss with BMCS.',
    ],
    'business-continuity-disaster-recovery' => [
        'short_description' => 'Business continuity and disaster recovery planning to keep operations running through disruption.',
        'description' => 'Business continuity planning prepares your organization to keep operating through unexpected disruption, while disaster recovery ensures your systems and data can be restored quickly. We help businesses build practical, tested continuity and recovery plans.',
        'technologies' => 'Disaster recovery planning, backup replication, recovery time objectives (RTO/RPO)',
        'meta_title' => 'Business Continuity & Disaster Recovery in Dubai',
        'meta_description' => 'Business continuity and disaster recovery planning in Dubai and the UAE, helping businesses prepare for and recover from unexpected disruption.',
    ],

    // --- Security & Surveillance ---
    'cctv-surveillance' => [
        'short_description' => 'CCTV camera system design and installation for round-the-clock premises monitoring.',
        'description' => 'A well-designed CCTV system gives you visibility across entry points, storage areas and shared spaces, with centralized recording and remote viewing. We design and install networked CCTV systems suited to the size and layout of your premises.',
        'technologies' => 'Networked IP cameras, centralized video recording, remote viewing',
        'meta_title' => 'CCTV Surveillance Installation in Dubai',
        'meta_description' => 'CCTV camera system design and installation in Dubai and the UAE — networked surveillance solutions with remote viewing, installed by BMCS.',
    ],
    'access-control' => [
        'short_description' => 'Access control and biometric systems that manage and record entry to your premises.',
        'description' => 'Control who can enter sensitive areas of your business with card, PIN or biometric access control systems. We design and install access control solutions that can be managed centrally and, where needed, integrated with time-attendance tracking.',
        'technologies' => 'Card/biometric access control, door entry systems, time attendance',
        'meta_title' => 'Access Control Systems in Dubai',
        'meta_description' => 'Access control and biometric entry system installation in Dubai — manage and record access to your business premises with BMCS.',
    ],
    'firewall-solutions' => [
        'short_description' => 'Firewall configuration and network security hardening to protect your business from threats.',
        'description' => 'Your network firewall is the first line of defense against external threats. We configure and manage firewall solutions that protect your business network, balancing strong security with the access your team needs to work effectively.',
        'technologies' => 'Network firewalls, intrusion prevention, security policy configuration',
        'meta_title' => 'Firewall Solutions & Network Security in Dubai',
        'meta_description' => 'Firewall configuration and network security hardening in Dubai and the UAE, protecting your business network from external threats.',
    ],
    'antivirus-scanning' => [
        'short_description' => 'Antivirus and endpoint protection to keep business devices safe from malware.',
        'description' => 'We deploy and manage antivirus and endpoint protection software across your business devices, helping guard against malware, ransomware and other threats that can disrupt operations or compromise data.',
        'technologies' => 'Endpoint antivirus, malware protection, centralized security management',
        'meta_title' => 'Antivirus & Endpoint Protection in Dubai',
        'meta_description' => 'Antivirus and endpoint protection deployment in Dubai — BMCS helps keep business devices and data safe from malware and other threats.',
    ],

    // --- Telecommunication ---
    'pabx-ip-telephony' => [
        'short_description' => 'PABX and IP telephony systems for clear, reliable business communication.',
        'description' => 'A modern PABX or IP telephony system gives your business flexible extensions, voicemail and call routing, whether you are setting up a new office or replacing an outdated analogue system. We design, install and configure phone systems suited to your team size.',
        'technologies' => 'IP PBX, SIP trunking, extension and voicemail configuration',
        'meta_title' => 'PABX & IP Telephony Systems in Dubai',
        'meta_description' => 'PABX and IP telephony installation in Dubai and the UAE — reliable business phone systems designed and configured by BMCS.',
    ],
    'telephone-recording-system' => [
        'short_description' => 'Call recording systems for training, quality assurance and record-keeping.',
        'description' => 'Recording business calls supports staff training, quality assurance and dispute resolution. We install telephone recording systems that integrate with your existing PABX or IP telephony setup, configured to match your retention requirements.',
        'technologies' => 'Call recording integration, retention policy configuration',
        'meta_title' => 'Telephone Call Recording Systems in Dubai',
        'meta_description' => 'Telephone recording system installation in Dubai — call recording solutions for training, quality assurance and compliance, from BMCS.',
    ],

    // --- Microsoft & Business Solutions ---
    'microsoft-365' => [
        'short_description' => 'Microsoft 365 / Office 365 setup, migration and administration for your business.',
        'description' => 'Microsoft 365 brings email, file storage and productivity apps together in the cloud. We handle setup, mailbox and file migration, licensing and ongoing administration, so your team can work securely from any device.',
        'technologies' => 'Microsoft 365, Exchange Online, OneDrive/SharePoint',
        'meta_title' => 'Microsoft 365 Setup & Migration in Dubai',
        'meta_description' => 'Microsoft 365 / Office 365 setup and migration services in Dubai and the UAE, handled end-to-end by BMCS.',
    ],
    'microsoft-licensing' => [
        'short_description' => 'Microsoft licensing guidance and procurement to keep your business properly licensed.',
        'description' => 'Choosing and managing Microsoft licensing can be confusing, and getting it wrong carries compliance risk. We assess your business needs and help you procure the right Microsoft licenses for your servers, desktops and cloud services.',
        'technologies' => 'Microsoft volume licensing, cloud subscription licensing',
        'meta_title' => 'Microsoft Licensing Services in Dubai',
        'meta_description' => 'Microsoft licensing assessment and procurement in Dubai — BMCS helps businesses stay correctly and cost-effectively licensed.',
    ],
    'tally-on-cloud' => [
        'short_description' => 'Tally on Cloud setup for accessing your accounting software securely from anywhere.',
        'description' => 'Running Tally from the cloud lets your finance team access accounting data securely from any location or device, without maintaining on-site infrastructure. We set up and configure Tally on Cloud for businesses moving away from local installations.',
        'technologies' => 'Cloud-hosted Tally, remote desktop access, data security configuration',
        'meta_title' => 'Tally on Cloud Setup in Dubai',
        'meta_description' => 'Tally on Cloud setup and configuration in Dubai and the UAE, giving your finance team secure, remote access to accounting software.',
    ],

    // --- IT Support & Distribution ---
    'it-consultancy' => [
        'short_description' => 'IT consultancy to help you plan technology decisions with confidence.',
        'description' => 'Whether you are planning an office move, a system upgrade or your overall technology roadmap, our IT consultancy service gives you practical, vendor-neutral advice grounded in real implementation experience.',
        'technologies' => 'IT infrastructure assessment, technology roadmap planning',
        'meta_title' => 'IT Consultancy Services in Dubai',
        'meta_description' => 'IT consultancy services in Dubai and the UAE — practical technology planning and advice for growing businesses, from BMCS.',
    ],
    'it-helpdesk' => [
        'short_description' => 'Responsive IT helpdesk support for day-to-day technical issues.',
        'description' => 'When something goes wrong, your team needs a fast, reliable point of contact. Our IT helpdesk support resolves day-to-day technical issues so your business can keep operating without lengthy downtime.',
        'technologies' => 'Remote and on-site technical support, issue tracking',
        'meta_title' => 'IT Helpdesk Support in Dubai',
        'meta_description' => 'IT helpdesk support in Dubai and the UAE — responsive technical support for day-to-day business IT issues, from BMCS.',
    ],
    'computer-hardware-supplies' => [
        'short_description' => 'Supply of servers, desktops, laptops and IT accessories for your business.',
        'description' => 'We supply and configure servers, desktops, laptops and IT accessories sourced to match your specifications and budget, ready to deploy across your team.',
        'technologies' => 'Servers, desktops, laptops, IT accessories and peripherals',
        'meta_title' => 'Computer Hardware Supplies in Dubai',
        'meta_description' => 'Supply of servers, desktops, laptops and IT accessories in Dubai and the UAE, configured and ready to deploy, from BMCS.',
    ],

    // --- Web & Digital ---
    'web-design-development' => [
        'short_description' => 'Website design and development that gives your business a professional online presence.',
        'description' => 'Your website is often the first impression a customer has of your business. We design and build websites that reflect your brand, communicate clearly and are built with performance and search visibility in mind.',
        'technologies' => 'Responsive web design, custom development, content management',
        'meta_title' => 'Website Design & Development in Dubai',
        'meta_description' => 'Website design and development services in Dubai and the UAE — professional, custom-built websites from BMCS.',
    ],
    'mobile-app-development' => [
        'short_description' => 'Mobile app development to extend your business to iOS and Android devices.',
        'description' => 'We design and develop mobile applications that support your business operations or customer experience, built for the platforms your users actually use.',
        'technologies' => 'iOS and Android app development, mobile UI/UX design',
        'meta_title' => 'Mobile App Development in Dubai',
        'meta_description' => 'Mobile app development services in Dubai and the UAE — custom iOS and Android apps built by BMCS.',
    ],
    'seo-sem' => [
        'short_description' => 'SEO and search engine marketing to help customers find your business online.',
        'description' => 'We improve your website\'s visibility in search results through on-page and technical SEO, paired with search engine marketing campaigns where paid visibility is the right fit for your goals.',
        'technologies' => 'On-page SEO, technical SEO, search engine marketing campaigns',
        'meta_title' => 'SEO & SEM Services in Dubai',
        'meta_description' => 'SEO and search engine marketing services in Dubai and the UAE, helping businesses improve their visibility in search results.',
    ],
    'graphic-design-branding' => [
        'short_description' => 'Graphic design and branding services for a consistent, professional identity.',
        'description' => 'From logos to marketing collateral, we provide graphic design and branding services that give your business a consistent, professional identity across digital and print.',
        'technologies' => 'Brand identity design, marketing collateral, print media',
        'meta_title' => 'Graphic Design & Branding Services in Dubai',
        'meta_description' => 'Graphic design and branding services in Dubai and the UAE — consistent, professional visual identity from BMCS.',
    ],

    // --- Audio Visual ---
    'video-conferencing' => [
        'short_description' => 'Video conferencing setup for smooth, professional remote and hybrid meetings.',
        'description' => 'We design and install video conferencing systems suited to your meeting room size and layout, so remote and in-person participants can collaborate clearly and reliably.',
        'technologies' => 'Video conferencing systems, meeting room audio-visual integration',
        'meta_title' => 'Video Conferencing Solutions in Dubai',
        'meta_description' => 'Video conferencing system setup and installation in Dubai and the UAE, for smooth, professional hybrid meetings, from BMCS.',
    ],
    'projectors' => [
        'short_description' => 'Projector supply and installation for meeting rooms, training spaces and events.',
        'description' => 'We supply and install projectors and display equipment for meeting rooms, training spaces and event setups, configured for reliable day-to-day use.',
        'technologies' => 'Projectors, display mounting, presentation equipment',
        'meta_title' => 'Projector Installation Services in Dubai',
        'meta_description' => 'Projector supply and installation in Dubai and the UAE, for meeting rooms, training spaces and events, from BMCS.',
    ],
];
