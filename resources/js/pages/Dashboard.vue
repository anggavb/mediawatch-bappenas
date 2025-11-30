<template>
  <div class="dashboard-main-body">

    <Breadcrumb title="Analytics" :breadcrumbs="[
      { name: 'Analytics' }
    ]" />
    <div class="row gy-4">
      <AnalyticsWidget />
      <RevenueStatistic />
      <SupportTracker />
      <AverageDailySales />
      <Transactions />
      <SalesbyCountries />
      <SourceVisitors />
      <MonthlyCampaignState />
      <RecentActivity />
    </div>
  </div>
</template>

<script setup>
import Breadcrumb from '@/components/Breadcrumb.vue';
import ApexCharts from "vue3-apexcharts";
import { Icon } from "@iconify/vue"; 
import AnalyticsWidget from "@/components/dashboard/AnalyticsWidget.vue"
import RevenueStatistic from "@/components/dashboard/RevenueStatistic.vue"
import SupportTracker from "@/components/dashboard/SupportTracker.vue"
import AverageDailySales from "@/components/dashboard/AverageDailySales.vue"
import Transactions from "@/components/dashboard/Transactions.vue"
import SalesbyCountries from "@/components/dashboard/SalesbyCountries.vue"
import SourceVisitors from "@/components/dashboard/SourceVisitors.vue"
import MonthlyCampaignState from "@/components/dashboard/MonthlyCampaign.vue"
import RecentActivity from "@/components/dashboard/RecentActivity.vue"
</script>