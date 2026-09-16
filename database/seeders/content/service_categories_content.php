<?php

/**
 * Category-level content templates. Individual services inherit these
 * (capabilities/benefits/applications/faq) unless they define their own
 * override in services_content.php — keeps 25+ service pages consistent
 * and maintainable without duplicating the same bullets everywhere.
 */

return [
    'network-infrastructure' => [
        'description' => 'Structured cabling, wireless networks and core infrastructure that keep every device, workstation and system in your business reliably connected.',
        'capabilities' => [
            'Structured cabling design and installation (Cat6/Cat6a and fiber optic backbone)',
            'Enterprise wireless network planning and deployment',
            'Network switching, routing and VPN configuration',
            'Network performance assessment and troubleshooting',
        ],
        'benefits' => [
            'A stable network foundation that scales as your business grows',
            'Reduced downtime from cabling and connectivity issues',
            'Secure remote access for staff working outside the office',
        ],
        'applications' => [
            'New office fit-outs and relocations',
            'Multi-floor and multi-site connectivity',
            'Upgrading legacy cabling and outdated network hardware',
        ],
        'faq' => [
            ['q' => 'Do you work with existing infrastructure or only new installations?', 'a' => 'Both. We regularly assess and upgrade existing cabling and network hardware as well as design infrastructure for new fit-outs.'],
            ['q' => 'Can you support multi-floor or multi-branch offices?', 'a' => 'Yes, our network designs are built to scale across floors and locations while keeping a single, manageable network architecture.'],
        ],
    ],
    'cloud-data' => [
        'description' => 'Cloud infrastructure, backup and disaster recovery services that keep your data safe, available and accessible from anywhere.',
        'capabilities' => [
            'Cloud infrastructure setup and migration planning',
            'Automated, scheduled backup solutions',
            'Business continuity and disaster recovery planning',
            'Cloud storage and file-sharing configuration',
        ],
        'benefits' => [
            'Reduced risk of data loss from hardware failure or site incidents',
            'Access to business systems and files from any location',
            'Predictable, scalable infrastructure costs',
        ],
        'applications' => [
            'Migrating on-premises servers and storage to the cloud',
            'Protecting critical business data with automated backups',
            'Enabling remote and hybrid work for distributed teams',
        ],
        'faq' => [
            ['q' => 'How often are backups performed?', 'a' => 'Backup frequency is configured around your business needs, typically on a daily or continuous schedule, with regular restore testing.'],
            ['q' => 'Can you migrate our existing systems without downtime?', 'a' => 'We plan migrations to minimize disruption, scheduling cutover windows outside of business hours wherever possible.'],
        ],
    ],
    'security-surveillance' => [
        'description' => 'CCTV surveillance, access control and firewall solutions that protect your premises, people and data around the clock.',
        'capabilities' => [
            'CCTV system design, installation and networked recording',
            'Access control and biometric time attendance systems',
            'Firewall configuration and network security hardening',
            'Antivirus and endpoint protection deployment',
        ],
        'benefits' => [
            'Round-the-clock visibility across your premises',
            'Controlled, auditable access to sensitive areas',
            'Reduced exposure to network-based security threats',
        ],
        'applications' => [
            'Retail, warehouse and office premises monitoring',
            'Restricting access to server rooms and secure areas',
            'Protecting business networks from external threats',
        ],
        'faq' => [
            ['q' => 'Can CCTV footage be accessed remotely?', 'a' => 'Yes, networked CCTV systems can be configured for secure remote viewing from authorized devices.'],
            ['q' => 'Do you integrate access control with existing security systems?', 'a' => 'Where feasible, we integrate access control and CCTV so they can be managed together.'],
        ],
    ],
    'telecommunication' => [
        'description' => 'PABX, IP telephony and call recording systems that keep your business communicating clearly, internally and with customers.',
        'capabilities' => [
            'PABX and IP telephony system design and installation',
            'Telephone call recording system setup',
            'Extension, voicemail and call-routing configuration',
            'Integration with existing office telephony infrastructure',
        ],
        'benefits' => [
            'Clearer, more reliable internal and external communication',
            'Call records available for training and quality purposes',
            'Flexible extensions that scale with your team',
        ],
        'applications' => [
            'New office phone system installations',
            'Replacing outdated analogue PABX systems',
            'Call centers and customer support desks',
        ],
        'faq' => [
            ['q' => 'Can you replace our existing analogue phone system?', 'a' => 'Yes, we assess your current setup and migrate you to an IP-based system with minimal disruption.'],
            ['q' => 'Is call recording compliant with company policy requirements?', 'a' => 'Recording settings are configured to match your internal policy and retention requirements.'],
        ],
    ],
    'microsoft-business-solutions' => [
        'description' => 'Microsoft server platforms, licensing and cloud productivity tools, configured and licensed correctly for your business.',
        'capabilities' => [
            'Microsoft 365 / Office 365 setup and administration',
            'Microsoft server platform deployment and configuration',
            'Licensing assessment and procurement guidance',
            'Business application setup, including Tally on Cloud',
        ],
        'benefits' => [
            'Correctly licensed software, reducing compliance risk',
            'Cloud-based productivity tools accessible from any device',
            'Centralized user and device management',
        ],
        'applications' => [
            'Migrating email and file storage to Microsoft 365',
            'Setting up new starters with correctly licensed software',
            'Running accounting software from the cloud',
        ],
        'faq' => [
            ['q' => 'Can you help us choose the right Microsoft licensing plan?', 'a' => 'Yes, we assess your team size and usage patterns to recommend an appropriately licensed plan.'],
            ['q' => 'Do you handle the full Microsoft 365 migration?', 'a' => 'We handle setup, mailbox and file migration, and user onboarding.'],
        ],
    ],
    'it-support-distribution' => [
        'description' => 'IT consultancy, helpdesk support and hardware supply, giving your business a single point of contact for day-to-day technology needs.',
        'capabilities' => [
            'IT consultancy and technology planning',
            'Ongoing IT helpdesk support',
            'Supply of servers, desktops, laptops and accessories',
            'Hardware setup, configuration and deployment',
        ],
        'benefits' => [
            'A single, accountable partner for IT hardware and support',
            'Faster resolution of day-to-day technical issues',
            'Hardware sourced and configured to your requirements',
        ],
        'applications' => [
            'Ongoing day-to-day IT support for office teams',
            'Equipping new hires with ready-to-use hardware',
            'Planning technology budgets and upgrades',
        ],
        'faq' => [
            ['q' => 'Do you offer ongoing support contracts?', 'a' => 'Yes, we offer helpdesk support arrangements suited to your business size and needs.'],
            ['q' => 'Can you source specific hardware brands or models?', 'a' => 'We can source servers, desktops, laptops and accessories based on your specifications and budget.'],
        ],
    ],
    'web-digital' => [
        'description' => 'Website design, development and digital marketing services that give your business a professional, effective online presence.',
        'capabilities' => [
            'Website design and development',
            'Mobile app development',
            'SEO and search engine marketing (SEM)',
            'Graphic design and branding',
        ],
        'benefits' => [
            'A professional online presence that reflects your brand',
            'Improved visibility in search engine results',
            'Consistent branding across digital and print materials',
        ],
        'applications' => [
            'Launching a new business website',
            'Improving search visibility for an existing site',
            'Building a mobile app to support business operations',
        ],
        'faq' => [
            ['q' => 'Do you build custom websites or use templates?', 'a' => 'We design and build websites suited to your brand and requirements rather than generic templates.'],
            ['q' => 'Can you improve the SEO of our existing website?', 'a' => 'Yes, we assess your current site and implement on-page and technical SEO improvements.'],
        ],
    ],
    'audio-visual' => [
        'description' => 'Video conferencing, projectors and audio-visual systems that make meetings, presentations and shared spaces work smoothly.',
        'capabilities' => [
            'Video conferencing system setup',
            'Projector supply and installation',
            'Meeting room audio-visual integration',
            'Ongoing AV equipment support',
        ],
        'benefits' => [
            'Reliable video conferencing for remote and hybrid meetings',
            'Clear, professional presentations in meeting rooms',
            'Equipment configured and ready to use',
        ],
        'applications' => [
            'Equipping meeting and boardrooms for video calls',
            'Presentation setups for training and events',
            'Upgrading outdated projector and display equipment',
        ],
        'faq' => [
            ['q' => 'Can you set up video conferencing for hybrid meetings?', 'a' => 'Yes, we configure video conferencing systems suited to your meeting room size and layout.'],
            ['q' => 'Do you support the equipment after installation?', 'a' => 'We provide ongoing support for AV equipment we install.'],
        ],
    ],
];
