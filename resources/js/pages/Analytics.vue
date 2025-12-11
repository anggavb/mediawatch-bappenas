<script setup>
import AppLayout from '@/AppLayout.vue'
import Breadcrumb from '@components/Breadcrumb.vue'
import { Icon } from "@iconify/vue"
import AnalyticsWidget from "@components/Analytics/AnalyticsWidget.vue"
import RevenueStatistic from "@components/Analytics/RevenueStatistic.vue"
import SupportTracker from "@components/Analytics/SupportTracker.vue"
import AverageDailySales from "@components/Analytics/AverageDailySales.vue"
import Transactions from "@components/Analytics/Transactions.vue"
import SalesbyCountries from "@components/Analytics/SalesbyCountries.vue"
import SourceVisitors from "@components/Analytics/SourceVisitors.vue"
import MonthlyCampaignState from "@components/Analytics/MonthlyCampaign.vue"
import RecentActivity from "@components/Analytics/RecentActivity.vue"

defineOptions({ layout: AppLayout })
</script>

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
