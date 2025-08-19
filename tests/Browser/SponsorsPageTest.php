<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SponsorsPageTest extends DuskTestCase
{
    public function test_sponsors_page_loads_successfully(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Shape the')
                ->assertSee('Future')
                ->assertSee('Become a Sponsor')
                ->assertSee('Empower the next generation of PHP developers');
        });
    }

    public function test_hero_section_displays_correctly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('15K+')
                ->assertSee('Active Developers')
                ->assertSee('200+')
                ->assertSee('Expert Mentors')
                ->assertSee('3M+')
                ->assertSee('Monthly Views')
                ->assertSee('97%')
                ->assertSee('Success Rate');
        });
    }

    public function test_become_sponsor_button_and_packages_section_exist(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertPresent('a[href="#sponsor-packages"]')
                ->assertPresent('#sponsor-packages')
                ->assertSee('Sponsorship')
                ->assertSee('Packages');
        });
    }

    public function test_learn_more_button_and_why_sponsor_section_exist(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertPresent('a[href="#why-sponsor"]')
                ->assertPresent('#why-sponsor')
                ->assertSee('Why Partner with');
        });
    }

    public function test_why_sponsor_section_displays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Why Partner with')
                ->assertSee('phpuzem?')
                ->assertSee('Massive Reach')
                ->assertSee('Developer-Focused')
                ->assertSee('Measurable Results')
                ->assertSee('3M+ monthly views')
                ->assertSee('15,000+ active developers')
                ->assertSee('75,000+ social media followers');
        });
    }

    public function test_mentorship_benefits_section_displays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Our Mentorship Program')
                ->assertSee('1-on-1 Mentoring Sessions')
                ->assertSee('Group Learning Environments')
                ->assertSee('Career Development Support')
                ->assertSee('Career planning & goal setting')
                ->assertSee('Resume & portfolio reviews')
                ->assertSee('Interview preparation & mock interviews');
        });
    }

    public function test_mentorship_statistics_display(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Mentorship Success Statistics')
                ->assertSee('Salary Increase')
                ->assertSee('+320%')
                ->assertSee('Promotion Rate')
                ->assertSee('94%')
                ->assertSee('Job Finding Time')
                ->assertSee('2 Weeks')
                ->assertSee('Satisfaction Rate')
                ->assertSee('98%');
        });
    }

    public function test_sponsorship_packages_display_correctly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Sponsorship')
                ->assertSee('Packages')
                ->assertSee('Community')
                ->assertSee('$500')
                ->assertSee('Growth')
                ->assertSee('$1,500')
                ->assertSee('Most Popular')
                ->assertSee('Enterprise')
                ->assertSee('$5,000')
                ->assertSee('per month');
        });
    }

    public function test_community_package_details(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Logo in website footer')
                ->assertSee('Monthly newsletter mention')
                ->assertSee('Social media mentions')
                ->assertSee('Access to private Discord channel')
                ->assertSee('Monthly performance reports');
        });
    }

    public function test_growth_package_details(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Everything in Community')
                ->assertSee('Logo in blog articles (3M+ readers)')
                ->assertSee('YouTube video sponsor mentions')
                ->assertSee('Dedicated partnership blog post')
                ->assertSee('Free job postings in community')
                ->assertSee('Monthly talent pipeline report');
        });
    }

    public function test_enterprise_package_details(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Everything in Growth')
                ->assertSee('Custom training programs (for your team)')
                ->assertSee('Dedicated webinar series (monthly)')
                ->assertSee('Technical consulting (25 hours/month)')
                ->assertSee('Speaking opportunities at events')
                ->assertSee('Quarterly strategy sessions');
        });
    }

    public function test_email_links_work_correctly(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertAttribute('a[href*="mailto:sponsors@phpuzem.com"][href*="Community%20Package"]', 'href', 'mailto:sponsors@phpuzem.com?subject=Community%20Package%20Sponsorship')
                ->assertAttribute('a[href*="mailto:sponsors@phpuzem.com"][href*="Growth%20Package"]', 'href', 'mailto:sponsors@phpuzem.com?subject=Growth%20Package%20Sponsorship')
                ->assertAttribute('a[href*="mailto:sponsors@phpuzem.com"][href*="Enterprise%20Package"]', 'href', 'mailto:sponsors@phpuzem.com?subject=Enterprise%20Package%20Sponsorship')
                ->assertAttribute('a[href*="mailto:sponsors@phpuzem.com"][href*="Custom%20Sponsorship"]', 'href', 'mailto:sponsors@phpuzem.com?subject=Custom%20Sponsorship%20Package%20Request');
        });
    }

    public function test_custom_solution_section_displays(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Looking for a Custom Solution?')
                ->assertSee('Every organization has unique needs')
                ->assertSee("Let's Talk")
                ->assertSee('Call Now');
        });
    }

    public function test_page_has_proper_title(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertTitle('Become a Sponsor - phpuzem');
        });
    }

    public function test_partnership_benefits_section(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Partnership Benefits')
                ->assertSee('Not Just Sponsorship—Partnership')
                ->assertSee('Trusted Content')
                ->assertSee('Quality Community')
                ->assertSee('Long-term Partnership')
                ->assertSee('Measurable ROI');
        });
    }

    public function test_page_responsive_design(): void
    {
        $this->browse(function (Browser $browser) {
            // Test mobile view
            $browser->resize(375, 667)
                ->visit('/sponsors')
                ->assertSee('Shape the')
                ->assertSee('Future')
                ->assertSee('Become a Sponsor')
                ->assertSee('Learn More');

            // Test tablet view
            $browser->resize(768, 1024)
                ->visit('/sponsors')
                ->assertSee('Shape the')
                ->assertSee('Future')
                ->assertSee('15K+')
                ->assertSee('Active Developers');

            // Test desktop view
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Shape the')
                ->assertSee('Future')
                ->assertSee('Our Mentorship Program')
                ->assertSee('Sponsorship');
        });
    }

    public function test_header_navigation_sponsors_link_is_active(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertAttribute('a[href="/sponsors"]', 'class', 'px-3 py-2 text-sm font-medium text-red-600 dark:text-red-400 transition-colors');
        });
    }

    public function test_all_sections_are_visible(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                // Hero section
                ->assertSee('Shape the')
                ->assertSee('Future')
                // Why sponsor section
                ->assertSee('Why Partner with')
                // Mentorship section
                ->assertSee('Our Mentorship Program')
                // Sponsorship packages section
                ->assertSee('Sponsorship')
                ->assertSee('Packages')
                // Custom solution section
                ->assertSee('Looking for a Custom Solution?');
        });
    }

    public function test_hero_badge_and_description(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertSee('Support the PHP Community')
                ->assertSee('lasting impact')
                ->assertSee('on thousands of careers');
        });
    }

    public function test_navigation_anchors_exist(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->resize(1200, 800)
                ->visit('/sponsors')
                ->assertPresent('a[href="#sponsor-packages"]')
                ->assertPresent('a[href="#why-sponsor"]')
                ->assertPresent('#sponsor-packages')
                ->assertPresent('#why-sponsor')
                ->assertSee('Become a Sponsor')
                ->assertSee('Learn More');
        });
    }
}
