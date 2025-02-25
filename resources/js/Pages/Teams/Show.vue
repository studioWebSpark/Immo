<script setup>
import { Head } from '@inertiajs/vue3';
import DashboardLayout from '@/Layouts/DashboardLayout.vue';
import DeleteTeamForm from '@/Pages/Teams/Partials/DeleteTeamForm.vue';
import SectionBorder from '@/Components/SectionBorder.vue';
import TeamMemberManager from '@/Pages/Teams/Partials/TeamMemberManager.vue';
import UpdateTeamNameForm from '@/Pages/Teams/Partials/UpdateTeamNameForm.vue';

const props = defineProps({
    team: Object,
    availableRoles: Array,
    permissions: Object,
});
</script>

<template>
    <Head :title="'Équipe ' + team.name" />

    <DashboardLayout :title="'Équipe ' + team.name">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Équipe {{ team.name }}
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div v-if="permissions.canUpdateTeam">
                    <UpdateTeamNameForm :team="team" :permissions="permissions" />

                    <SectionBorder />
                </div>

                <div v-if="permissions.canAddTeamMembers">
                    <TeamMemberManager
                        :team="team"
                        :available-roles="availableRoles"
                        :user-permissions="permissions"
                    />
                </div>

                <div v-if="permissions.canDeleteTeam && ! team.personal_team">
                    <SectionBorder />

                    <DeleteTeamForm :team="team" />
                </div>
            </div>
        </div>
    </DashboardLayout>
</template>
