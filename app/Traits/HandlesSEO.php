<?php

namespace App\Traits;

use App\Services\SEOService;

trait HandlesSEO
{
    /**
     * Get SEO service instance
     */
    protected function seoService(): SEOService
    {
        return app(SEOService::class);
    }

    /**
     * Set page SEO data for layout
     */
    protected function setSEOData(array $seoData, ?array $structuredData = null): array
    {
        $data = ['seoData' => $seoData];

        if ($structuredData) {
            $data['structuredData'] = $structuredData;
        }

        return $data;
    }

    /**
     * Get homepage SEO data
     */
    protected function getHomepageSEO(): array
    {
        return $this->setSEOData(
            $this->seoService()->getHomepageSEO(),
            $this->seoService()->getHomepageStructuredData()
        );
    }

    /**
     * Get post SEO data
     */
    protected function getPostSEO($post): array
    {
        return $this->setSEOData(
            $this->seoService()->getPostSEO($post),
            $this->seoService()->getPostStructuredData($post)
        );
    }

    /**
     * Get category SEO data
     */
    protected function getCategorySEO($category): array
    {
        return $this->setSEOData(
            $this->seoService()->getCategorySEO($category)
        );
    }

    /**
     * Get pricing SEO data
     */
    protected function getPricingSEO(): array
    {
        return $this->setSEOData(
            $this->seoService()->getPricingSEO()
        );
    }

    /**
     * Get generic page SEO data
     */
    protected function getPageSEO(string $title, ?string $description = null, array $extra = []): array
    {
        return $this->setSEOData(
            $this->seoService()->getPageSEO($title, $description, $extra)
        );
    }
}
