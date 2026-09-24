<?php

/**
 * Tally service pages. Each service carries its own description, capabilities,
 * benefits, use cases and FAQ — nothing is shared or inherited from the
 * category, so every page answers the questions specific to that service.
 *
 * In `description`, blocks are separated by blank lines and a block that
 * starts with "## " is rendered as an H2 sub-heading (see services/show.php).
 *
 * Product facts (TallyPrime Server needs a Gold licence, concurrent-user
 * behaviour, session monitoring, TSS scope) follow Tally Solutions' public
 * product information, paraphrased. No prices are stated: pricing depends on
 * edition and user count and is quoted per business.
 */

return [
    'tallyprime-sales' => [
        'name' => 'TallyPrime Sales & Licensing',
        'short_description' => 'TallyPrime Silver and Gold licences for Dubai and UAE businesses — with help choosing the right edition and getting set up correctly.',
        'description' => "TallyPrime is business management software covering accounting, inventory, VAT, invoicing, banking and reporting. Bright Mind Computer Solutions supplies TallyPrime licences to businesses across Dubai and the UAE, and handles the whole start-up: choosing the edition, activating the licence and configuring your first company.\n\n## Choosing the right edition\n\nTallyPrime Silver is the single-user edition, suited to an owner-managed business or a single accountant. TallyPrime Gold is the multi-user edition for teams that need several people working in the same company at once. Larger, high-concurrency environments can add TallyPrime Server on top of Gold. We look at how many people enter data, how many locations you operate from and how you report, then recommend the edition that fits rather than the biggest one.\n\n## TallyPrime price in the UAE\n\nThe cost of TallyPrime depends on the edition and the number of users, so we prepare a written quotation for your specific set-up instead of quoting a one-size-fits-all figure. Request a quotation and we will confirm the licence, the first-year subscription position and any set-up work in one document.",
        'technologies' => 'TallyPrime Silver (single user), TallyPrime Gold (multi-user), TallyPrime Server, UAE VAT configuration',
        'capabilities' => [
            'Licence needs assessment: users, locations, reporting and growth plans',
            'Silver vs Gold edition recommendation, with an upgrade path explained up front',
            'Written quotation for new licences and Silver-to-Gold upgrades',
            'Licence activation and account registration handled on your behalf',
            'First company creation, chart of accounts, stock masters and UAE VAT configuration',
            'User roles and security levels set up before anyone starts entering data',
            'Hands-on orientation for your accounts team on the day of go-live',
        ],
        'benefits' => [
            'A licence sized to your team, not oversized or outgrown in a year',
            'One quotation covering licence and set-up, with no surprises',
            'Live and transacting in TallyPrime faster, with VAT configured correctly',
            'A local Dubai team to call from day one',
        ],
        'applications' => [
            'New companies choosing accounting software for the first time',
            'Owner-managed businesses that need a single-user TallyPrime Silver licence',
            'Growing teams moving from Silver to multi-user Gold',
            'Trading, distribution and service businesses that need inventory and VAT in one system',
        ],
        'faq' => [
            ['q' => 'What is the difference between TallyPrime Silver and Gold?', 'a' => 'Silver is the single-user edition. Gold allows multiple users to work in the same company at the same time. If you outgrow Silver, a licence upgrade to Gold is available.'],
            ['q' => 'How much does TallyPrime cost in the UAE?', 'a' => 'The price depends on the edition and the number of users. Send us your requirements through the quotation form or WhatsApp and we will reply with a written quotation.'],
            ['q' => 'Can you set up TallyPrime for UAE VAT?', 'a' => 'Yes. We configure VAT ledgers, tax rates and invoice settings as part of the initial company set-up so your invoices and returns are prepared correctly from the start.'],
            ['q' => 'How long does it take to get started?', 'a' => 'A straightforward single-user set-up can often be completed in a day. Multi-user set-ups with data import take longer; we confirm the timeline in the quotation.'],
        ],
        'meta_title' => 'TallyPrime Dubai: Sales & Licensing',
        'meta_description' => 'Buy TallyPrime in Dubai and the UAE. Silver and Gold licences with VAT set-up, activation and a written quotation from Bright Mind Computer Solutions.',
    ],

    'tally-renewal' => [
        'name' => 'TSS Renewal',
        'short_description' => 'TallyPrime TSS renewal in Dubai and the UAE — tracked, invoiced and renewed on time so updates and connected services never lapse.',
        'description' => "TSS (Tally Software Services) is the subscription that keeps a TallyPrime licence current. It is what gives you product updates and access to Tally's connected services and subscription features. When it expires, those benefits stop until the subscription is renewed.\n\nBright Mind Computer Solutions manages TSS renewal for businesses across Dubai and the UAE. We keep track of your expiry date, contact you ahead of it, quote the renewal and complete it, so nobody in your accounts team has to chase it.\n\n## Already lapsed?\n\nIf your TSS has already expired, we can review the licence, explain what is needed to bring it back into a current state, and get it renewed. It is better to renew before expiry, but a lapse is usually fixable.",
        'technologies' => 'TSS (Tally Software Services), TallyPrime licence renewal, licence status review',
        'capabilities' => [
            'Licence and TSS status check, including the expiry date',
            'Advance renewal reminders before your subscription expires',
            'Renewal quotation for Silver and Gold licences',
            'Renewal completed and confirmed on your behalf',
            'Reactivation guidance when TSS has already lapsed',
            'Upgrade to the latest TallyPrime release after renewal',
            'Renewal record kept so the next date is never missed',
        ],
        'benefits' => [
            'Stay on current TallyPrime releases and updates',
            'No lapse in access to connected services',
            'Renewal handled by one team that already knows your licence',
            'Predictable renewal cost, quoted in advance',
        ],
        'applications' => [
            'Businesses whose TSS expires this month or has recently expired',
            'Companies with several TallyPrime licences on different renewal dates',
            'Teams that inherited a licence and do not know its status',
            'Businesses ready to upgrade to the latest release after renewing',
        ],
        'faq' => [
            ['q' => 'What is TSS in Tally?', 'a' => 'TSS stands for Tally Software Services. It is the subscription attached to a TallyPrime licence that provides product updates and access to connected services.'],
            ['q' => 'What happens if I do not renew TSS?', 'a' => 'You can keep using your licensed TallyPrime, but subscription benefits such as updates and connected services are no longer available until you renew.'],
            ['q' => 'How do I renew TallyPrime in Dubai?', 'a' => 'Send us your licence details or serial number. We check the status, send a renewal quotation and complete the renewal once you approve.'],
            ['q' => 'Can you renew a TSS that has already expired?', 'a' => 'In most cases, yes. We review the licence first and confirm what is needed before you commit to anything.'],
        ],
        'meta_title' => 'TSS Renewal & TallyPrime Renewal UAE',
        'meta_description' => 'Tally TSS renewal in Dubai and the UAE. We track your expiry date, quote the renewal and renew on time — including lapsed TallyPrime licences.',
    ],

    'tally-on-cloud' => [
        'name' => 'Tally on Cloud',
        'short_description' => 'Run TallyPrime on a secure cloud server and reach your accounts from anywhere — office, home or another emirate.',
        'description' => "Tally on Cloud means your TallyPrime installation and company data run on a secure remote server instead of a single office computer. Your team logs in over the internet and works in TallyPrime exactly as they would in the office, from any location and on the devices they already use.\n\nBright Mind Computer Solutions designs, configures and supports Tally on Cloud for businesses in Dubai and across the UAE, from the first server set-up to day-to-day help when someone cannot log in.\n\n## Why businesses move Tally to the cloud\n\nRemote and hybrid working, accountants who work off-site, and branches in different emirates all need access to the same books. Keeping data on one PC makes that hard and puts the business at risk if that PC fails. A cloud set-up centralises the data, adds scheduled backups and gives you one controlled place to manage who can log in.",
        'technologies' => 'Tally on Cloud, remote desktop access, secured cloud servers, scheduled backups, multi-user TallyPrime',
        'capabilities' => [
            'Access TallyPrime from anywhere with an internet connection',
            'Remote working for accountants, owners and auditors without carrying data',
            'Multi-location access, so head office and branches work on the same books',
            'Multi-user access, with a separate login for each team member',
            'Secure cloud environment with controlled user access',
            'Scheduled data backups configured during set-up',
            'Set-up and configuration, including moving your existing Tally data to the cloud',
            'Technical support from the Bright Mind team when users need help',
        ],
        'benefits' => [
            'Work from home, the office or on the road with the same data',
            'No dependence on a single office PC holding your accounts',
            'Your accountant or auditor can be given access without emailing backups',
            'One accountable support contact for Tally and the hosting environment',
        ],
        'applications' => [
            'Businesses with remote or hybrid accounts teams',
            'Companies with branches or warehouses in several emirates',
            'Owners who want to review reports while travelling',
            'External accountants and auditors who need controlled access',
        ],
        'faq' => [
            ['q' => 'Can I access TallyPrime from anywhere with Tally on Cloud?', 'a' => 'Yes. As long as you have an internet connection and your login, you can work in TallyPrime from any location and on most common devices.'],
            ['q' => 'Can several users work at the same time?', 'a' => 'Yes, provided the licence is multi-user. We assess your licence and users during set-up and advise if an upgrade is needed.'],
            ['q' => 'Is my data backed up?', 'a' => 'Yes. Scheduled backups are configured as part of the set-up, and we agree the frequency with you. Restores are handled by our team.'],
            ['q' => 'Can you move my existing Tally data to the cloud?', 'a' => 'Yes. We migrate your existing company data, verify it opens correctly in the cloud environment and then switch your users over.'],
            ['q' => 'Who supports us after set-up?', 'a' => 'The same Bright Mind team. Contact us by phone, WhatsApp or email for login help, performance issues or user changes.'],
        ],
        'meta_title' => 'Tally on Cloud UAE: Remote Access',
        'meta_description' => 'Tally on Cloud in Dubai and the UAE. Access TallyPrime from anywhere, with multi-user access, secure hosting, backups and set-up by Bright Mind.',
    ],

    'tally-customization' => [
        'name' => 'TallyPrime Customization & Implementation',
        'short_description' => 'Custom invoice formats, vouchers, reports and workflows — plus full implementation — so TallyPrime works the way your business does.',
        'description' => "Standard TallyPrime covers most accounting needs, but every business has its own invoice layout, approval steps, reports and data flows. Bright Mind Computer Solutions customises TallyPrime for businesses in Dubai and across the UAE using TDL (Tally Definition Language) and TallyPrime's own configuration options, then implements it end to end.\n\n## From requirement to working system\n\nWe start by mapping how you actually work, agree exactly what will change, build and test the customisation on a copy of your data, and roll it out with training. Nothing is switched on in your live company until you have signed it off.\n\n## Implementation\n\nFor new users, implementation covers company set-up, masters, opening balances, VAT, users and rights, and go-live training. For existing users, we review the current set-up and correct or extend it.",
        'technologies' => 'TDL (Tally Definition Language), custom print formats, custom reports, TallyPrime configuration, data import',
        'capabilities' => [
            'Customized invoice formats — your logo, layout, bilingual text, terms and VAT details',
            'Voucher customization — extra fields, mandatory checks and modified voucher screens',
            'Customized reports — management, sales, stock and receivables views built to your layout',
            'Business-specific workflows — approvals, order-to-invoice flows and rights by role',
            'Integration with other software, spreadsheets and online systems',
            'Data migration from older Tally versions or other accounting software',
            'Automation of repetitive entries, imports and scheduled outputs',
            'Implementation — company set-up, configuration, testing, training and go-live support',
        ],
        'benefits' => [
            'Invoices and reports that look and behave like your business',
            'Fewer manual steps and fewer keying errors',
            'Customisation tested before it touches your live data',
            'One team owning both the customisation and the support afterwards',
        ],
        'applications' => [
            'Trading companies that need a specific invoice or delivery-note layout',
            'Businesses that need extra fields on sales or purchase vouchers',
            'Management that wants reports Tally does not provide out of the box',
            'Companies rolling out TallyPrime for the first time who want it configured properly',
        ],
        'faq' => [
            ['q' => 'What can be customised in TallyPrime?', 'a' => 'Invoice and print formats, voucher screens and fields, reports, approval workflows and data imports or exports are the most common. If you have a specific requirement, describe it and we will confirm what is feasible.'],
            ['q' => 'Will customisation affect future TallyPrime updates?', 'a' => 'We build customisations to remain compatible with TallyPrime releases and re-test them when you upgrade, so an update does not silently break your formats.'],
            ['q' => 'Do you offer TallyPrime customization in Dubai on site?', 'a' => 'Yes. Analysis and training can be done on site in Dubai or remotely, whichever suits your team.'],
            ['q' => 'How is customisation priced?', 'a' => 'Each requirement is scoped and quoted before work starts, so you know the cost and deliverables in advance.'],
        ],
        'meta_title' => 'Tally Customization Dubai & UAE',
        'meta_description' => 'TallyPrime customization in Dubai and the UAE: invoice formats, vouchers, reports, workflows, automation and full implementation by Bright Mind.',
    ],

    'tallyprime-server' => [
        'name' => 'TallyPrime Server',
        'short_description' => 'A server-based data architecture for TallyPrime Gold, built for busy multi-user teams that need high concurrency, secure access and central control.',
        'description' => "TallyPrime Server adds a data-server architecture on top of the TallyPrime Gold licence. Instead of every user opening company data files directly, the data is managed centrally by the server and users connect to it. The result is better concurrency, tighter access control and monitoring that an administrator can actually use.\n\nBright Mind Computer Solutions plans, implements and supports TallyPrime Server for growing businesses in Dubai and across the UAE.\n\n## Built for a multi-user business environment\n\nWhen ten or more people are entering vouchers, running reports and importing data at the same time, a standard multi-user set-up can slow down at exactly the wrong moment. TallyPrime Server is designed for that environment, where many people work in the same company data all day and the business cannot afford interruptions.\n\n## High concurrency\n\nMultiple users can load companies, save transactions, export and print reports, import data and take backups at the same time, without stopping everyone else's work. For a finance team at month-end, or a branch network posting into one company, that is the difference between waiting and working.\n\n## Reliable performance\n\nBecause data handling sits with the server, users can keep recording transactions and viewing reports while backups run. We size the server hardware, storage and network for your user count so that the software's capability is not held back by the machine underneath it.\n\n## Secure data access\n\nUsers connect using the name of the data server rather than needing to know where data files sit, so raw company files are not scattered across office PCs. Permissions on the server control who may take backups or restore data, which keeps a sensitive task with the people who should have it.\n\n## Centralized monitoring and control\n\nAn authorised administrator can see who is logged in and what activity is in progress, and manage those sessions. That gives finance managers and IT one place to supervise access instead of asking around the office.\n\n## Implementation and support by Bright Mind\n\nWe assess your user count and workflows, confirm the licensing (TallyPrime Server requires a Gold licence), prepare the server and network, install and configure TallyPrime Server, migrate your data, set up users and permissions, train your team and stay on for support and maintenance.",
        'technologies' => 'TallyPrime Server, TallyPrime Gold licence, Windows server hardware, LAN and VPN connectivity, backup configuration',
        'capabilities' => [
            'Requirement and user-load assessment before you commit to a licence',
            'Server hardware, storage and network sizing for your user count',
            'Installation and configuration of TallyPrime Server on the server',
            'Migration of existing company data onto the data server',
            'User, role and permission setup, including who may back up and restore',
            'Multi-branch access over LAN or secure VPN',
            'Backup scheduling and restore testing',
            'Ongoing support, monitoring assistance and upgrades under an AMC',
        ],
        'benefits' => [
            'Many users can work at once without the system grinding to a halt',
            'Company data managed centrally instead of copied across PCs',
            'Backups can run while people keep working',
            'Administrators see and control who is logged in',
            'One partner for licensing, server, implementation and support',
        ],
        'applications' => [
            'Finance teams of ten or more users posting at the same time',
            'Companies with branches consolidating transactions to head office',
            'Distribution and trading businesses with heavy daily voucher volumes',
            'Groups of companies where several people work in the same data all day',
            'Businesses that need tighter control over who can back up, restore and access data',
        ],
        'faq' => [
            ['q' => 'What licence do I need for TallyPrime Server?', 'a' => 'TallyPrime Server works with the TallyPrime Gold licence. We review your current licence and quote any upgrade needed.'],
            ['q' => 'When does a business need TallyPrime Server instead of TallyPrime Gold?', 'a' => 'Typically when many users work at the same time and data volumes grow, and you want central control, monitoring and better concurrency. We assess your actual usage and tell you honestly if Gold is enough.'],
            ['q' => 'Can users keep working during a backup?', 'a' => 'Yes. With the data-server architecture, users can continue recording transactions and viewing reports while a backup runs.'],
            ['q' => 'Can branches in other emirates connect to the same server?', 'a' => 'Yes, over a secure network or VPN that we can design and configure alongside the server.'],
            ['q' => 'Do you provide the server hardware as well?', 'a' => 'Yes. As an IT solutions company we can specify and supply suitable server hardware and set up the network and backups around it.'],
        ],
        'meta_title' => 'TallyPrime Server UAE: Multi-User Setup',
        'meta_description' => 'TallyPrime Server in Dubai and the UAE: high-concurrency multi-user access, secure data and central control. Implemented and supported by Bright Mind.',
    ],

    'tally-support' => [
        'name' => 'Tally Support & AMC',
        'short_description' => 'Fast TallyPrime technical support in Dubai and the UAE, with annual maintenance contracts for businesses that cannot afford accounting downtime.',
        'description' => "When TallyPrime stops working on the day VAT is due or the month-end close is running, you need someone who picks up. Bright Mind Computer Solutions provides TallyPrime technical support to businesses in Dubai and across the UAE, either as a one-off fix or under an Annual Maintenance Contract (AMC).\n\n## Support when you need it\n\nOur team helps with error messages, slow performance, data that will not open, printing and format problems, user access issues, upgrades and 'how do I do this in Tally' questions. We work remotely where we can, and visit your office in Dubai when it is faster.\n\n## Annual Maintenance Contract (AMC)\n\nAn AMC covers your TallyPrime environment for the year: agreed response times, scheduled health checks and backup verification, help with updates, and priority when something breaks. It suits businesses that would rather budget once than be surprised.",
        'technologies' => 'TallyPrime remote support, on-site support, data repair, backup verification, AMC',
        'capabilities' => [
            'Phone, WhatsApp and email support for TallyPrime users',
            'Remote sessions to diagnose and fix problems quickly',
            'On-site visits within Dubai where a visit is faster',
            'Data repair and recovery from corrupted or damaged company data',
            'Backup checks and restore testing',
            'Help with TallyPrime updates and releases',
            'Annual Maintenance Contract with agreed response times',
            'How-to guidance and refresher training for your accounts team',
        ],
        'benefits' => [
            'Problems fixed by people who already know your set-up',
            'Less accounting downtime around VAT and month-end deadlines',
            'One yearly AMC fee instead of unpredictable call-out costs',
            'Backups verified before you need to rely on them',
        ],
        'applications' => [
            'Businesses with a busy accounts team that cannot wait days for a fix',
            'Companies that hit errors or slow performance in TallyPrime',
            'Organisations wanting scheduled health checks and backup verification',
            'Businesses without in-house IT who want a dedicated Tally contact',
        ],
        'faq' => [
            ['q' => 'What does a Tally AMC include?', 'a' => 'Agreed response times, scheduled checks, backup verification, help with updates and priority support. The exact scope is written into the contract so you know what is covered.'],
            ['q' => 'Can you fix a Tally company that will not open?', 'a' => 'In many cases, yes. We assess the data, attempt a repair and restore from backup if needed. Tell us the error you are seeing and we will advise.'],
            ['q' => 'Do you offer TallyPrime support in Dubai without an AMC?', 'a' => 'Yes. One-off support is available for a single issue, without a contract.'],
            ['q' => 'How do I reach support?', 'a' => 'By phone, WhatsApp or email. AMC customers get priority handling and agreed response times.'],
        ],
        'meta_title' => 'TallyPrime Support & AMC Dubai',
        'meta_description' => 'TallyPrime technical support and annual maintenance contracts in Dubai and the UAE: remote and on-site help, data repair and backup checks.',
    ],

    'tally-integration' => [
        'name' => 'Tally Integration & Data Migration',
        'short_description' => 'Move to TallyPrime without losing history, and connect it to your other systems so data is entered once.',
        'description' => "Two projects come up again and again for Tally users: moving data into TallyPrime from an older system, and connecting TallyPrime to the other software the business runs on. Bright Mind Computer Solutions handles both for businesses in Dubai and across the UAE.\n\n## Data migration\n\nWe migrate from Tally.ERP 9 to TallyPrime, from other accounting packages and from spreadsheets. We clean and map ledgers, stock items, opening balances and transaction history, load them into a test company, reconcile the totals with you and only then go live. Your old data stays untouched as a fallback.\n\n## Integration\n\nRe-keying the same sale in three systems wastes time and creates errors. We connect TallyPrime with sales, e-commerce, POS, CRM, payroll and payment tools using import and export templates and API-based links where the other system supports it, so that data flows in once and is reconciled in Tally.",
        'technologies' => 'Tally.ERP 9 to TallyPrime migration, Excel and CSV import, XML and API-based integration, reconciliation reports',
        'capabilities' => [
            'Migration from Tally.ERP 9 to TallyPrime with full history',
            'Migration from other accounting software or spreadsheets',
            'Ledger, stock item and opening-balance mapping and clean-up',
            'Trial migration and reconciliation before go-live',
            'Import of sales, purchase and bank entries from Excel or CSV',
            'Integration with e-commerce, POS, CRM and payroll systems',
            'Automated exports of TallyPrime data for other tools',
            'Post-migration checks and user training',
        ],
        'benefits' => [
            'Historical data carried over instead of started again',
            'Totals reconciled with you before the old system is retired',
            'Less duplicate entry and fewer keying mistakes',
            'Integrations documented so they can be supported later',
        ],
        'applications' => [
            'Businesses upgrading from Tally.ERP 9 to TallyPrime',
            'Companies switching from another accounting package',
            'Online and retail sellers posting daily sales into Tally',
            'Businesses that want payroll or CRM data to reach the books automatically',
        ],
        'faq' => [
            ['q' => 'Can you migrate our Tally.ERP 9 data to TallyPrime?', 'a' => 'Yes. We migrate and verify your data in a test company first, reconcile it with you and then move to live use.'],
            ['q' => 'Can you migrate from another accounting software?', 'a' => 'Usually yes. We map your ledgers, items and balances and import them, and we tell you upfront what history can and cannot be carried across.'],
            ['q' => 'Can TallyPrime connect to our online store or POS?', 'a' => 'In most cases, yes. The approach depends on what the other system can export or expose; we assess it and propose the simplest reliable link.'],
            ['q' => 'Is our old data at risk during migration?', 'a' => 'No. We work from copies, so your original data remains available if you need to fall back.'],
        ],
        'meta_title' => 'Tally Data Migration & Integration UAE',
        'meta_description' => 'TallyPrime data migration from Tally.ERP 9 or other software, plus integration with sales, POS and CRM systems, by Bright Mind in Dubai.',
    ],
];
