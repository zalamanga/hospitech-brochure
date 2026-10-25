<?php
declare(strict_types=1);

$products = [
    'eurotronik' => [
        'brand' => 'Eurotronik',
        'title' => 'Interactive IP Nurse Call System NurseCare',
        'subtitle' => 'Advanced IP nurse call, healthcare management, and nursing documentation in one connected device.',
        'accent' => '#0f766e',
        'summary' => [
            'NurseCare is an intelligent nurse call system for hospitals, clinics, nursing homes, and healthcare institutions.',
            'The system is based on Internet Protocol communication and supports secure, flexible installation in new or existing buildings.',
            'Existing nurse call systems can be integrated so care teams can modernize without replacing every part of the building infrastructure.',
        ],
        'features' => [
            ['Wireless IP nurse call system', 'Hand transmitters can work as both call buttons and fall sensors, helping staff respond quickly when a resident needs assistance.'],
            ['Revolutionary IP room touch display', 'NurseTab combines patient room communication, attendance visibility, service documentation, and care information in one touchscreen.'],
            ['Smart mobile app for staff', 'iNurse gives healthcare staff notifications, staff attendance visibility, and assistance calls without depending on a traditional pager.'],
            ['Interactive corridor display', 'InfoTab shows active calls, staff attendance, assistance calls, and optional daily information for corridors and shared spaces.'],
            ['Documenting maintenance work', 'Technical issues, cleaning tasks, and maintenance work can be recorded directly from the patient room display.'],
        ],
        'brochure' => 'Download Eurotronik NurseCall System Brochure',
    ],
    'intercall' => [
        'brand' => 'Intercall',
        'title' => 'The Touch Series',
        'subtitle' => 'Innovative care systems for nurse call and assisted care environments.',
        'accent' => '#2563eb',
        'summary' => [
            'Intercall develops and manufactures nurse call and assisted care systems that help healthcare staff manage care.',
            'The Touch Series enables patients and nursing staff to communicate regularly so priorities can be assessed faster.',
            'The system gives patients and families reassurance that help is available when needed.',
        ],
        'features' => [
            ['Touch Display', 'Room communication interface for clear patient and staff interaction.'],
            ['Touch Display Plus', 'Expanded control and display capability for richer care workflows.'],
            ['Corridor Display', 'Visible call information for clinical corridors and shared care areas.'],
            ['Call Point Standard', 'Reliable room-based call point for everyday care environments.'],
            ['The Care Card', 'Assisted care accessory for staff and patient workflows.'],
            ['Access Point', 'Connectivity point for system access and communication coverage.'],
            ['Call Point Plus', 'Enhanced patient call point with additional control options.'],
            ['LED Over Door Light', 'Room status visibility from outside the room.'],
            ['Call Point Basic', 'Simple call access for essential care communication.'],
            ['Wearable Call Point', 'Mobile call support for residents and patients.'],
            ['Bathroom Pull Cord', 'Accessible call trigger for bathrooms and wet areas.'],
            ['Pear Lead', 'Bedside patient call accessory.'],
            ['Portable Transmitter', 'Flexible call device for mobile care scenarios.'],
            ['SafeGuard Point', 'Safety-focused call point for higher risk areas.'],
            ['SafeGuard Sensor', 'Sensor support for patient safety monitoring.'],
        ],
        'brochure' => 'Download Intercall Touch Series Brochure',
    ],
    'rondish' => [
        'brand' => 'Rondish',
        'title' => 'SmartBeds',
        'subtitle' => 'IP based fall management systems for safer patient and resident monitoring.',
        'accent' => '#dc2626',
        'summary' => [
            'SmartBeds focuses on fall management and patient movement visibility for care teams.',
            'Caregivers can receive phone app notifications and notify the care station when an alert is handled.',
            'The system is designed for care environments that need faster escalation and clearer response status.',
        ],
        'features' => [
            ['Bed monitoring', 'Monitor bed movement and patient status with a ward-level safety workflow.'],
            ['Fall management', 'Support earlier response when fall risk or movement alerts are detected.'],
            ['Care station alerts', 'Bring key notifications back to the care station for team visibility.'],
            ['Mobile notifications', 'Notify caregivers through app-based alerts when response time matters.'],
            ['Handled status', 'Let staff acknowledge and update alerts as they are handled.'],
        ],
        'brochure' => 'Download Smartbeds Brochure',
    ],
    'medicare' => [
        'brand' => 'Medicare',
        'title' => 'Nurse Call Systems for Professionals',
        'subtitle' => 'Wireless nurse call technology built to meet the challenging demands of the care environment.',
        'accent' => '#7c3aed',
        'summary' => [
            'Medicare provides wireless nurse call technology for professional healthcare and care environments.',
            'The system is built around dependable communication, simple coverage, and fast access to help.',
            'It is suited for teams that need a flexible nurse call setup without a heavy infrastructure footprint.',
        ],
        'features' => [
            ['Wireless call coverage', 'Support responsive patient calls across rooms and care areas.'],
            ['Professional care workflow', 'Designed for staff who need clear signals and dependable daily operation.'],
            ['Flexible deployment', 'A practical option for care facilities with changing room and ward needs.'],
            ['Patient reassurance', 'Give patients and families confidence that help is easy to request.'],
        ],
        'brochure' => 'Download Medicare Brochure',
    ],
];

$contact = [
    'address' => 'No. 8, Jalan Industry USJ 1/8, Taman Perindustrian USJ 1, 47600 Subang Jaya, Selangor, Malaysia.',
    'phone' => '+60 3 8023 1161 / 2',
    'fax' => '+60 3 8023 1167',
    'email' => 'inquiry@xspec.com.my',
    'whatsapp' => 'https://xspechospitech.wasap.my',
];

return ['products' => $products, 'contact' => $contact];
