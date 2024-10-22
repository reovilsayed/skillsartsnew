<?php

namespace App\Repositories;

class CostRepository
{    
    /**
     * websites
     *
     * @return array
     */
    public static function websites(): array
    {
        return config('cost.websites');
    }

      /**
     * website
     *
     * @return array
     */
    public static function website(int $index): array
    {
        return config('cost.websites')[$index];
    }
    
    /**
     * organizations
     *
     * @return array
     */
    public static function organizations(): array
    {
        return config('cost.organizations');
    }
      /**
     * organization
     *
     * @return array
     */
    public static function organization(int $index): array
    {
        return config('cost.organizations')[$index];
    }
    /**
     * costPerPage
     *
     * @return int
     */
    public static function costPerPage(): int
    {
        return config('cost.cost_per_page');
    }
    
    /**
     * costPerEmail
     *
     * @return int
     */
    public static function costPerEmail(): int
    {
        return config('cost.cost_per_email');
    }
    
    /**
     * costPerLanguage
     *
     * @return int
     */
    public static function costPerLanguage(): int
    {
        return config('cost.cost_per_language');
    }
    
    /**
     * costForBlog
     *
     * @return int
     */
    
    public static function costForBlog(): int
    {
        return config('cost.cost_for_blog');
    }
        
    /**
     * costForEcommerce
     *
     * @return int
     */
    public static function costForEcommerce(): int
    {
        return config('cost.cost_for_ecommerce');
    }
    
    /**
     * costForSslCertificate
     *
     * @return int
     */
    public static function costForSslCertificate(): int
    {
        return config('cost.cost_for_ssl_certificate');
    }
}
