import { Datagrid, DateField, ReferenceManyField, Show, ShowView, TabbedShowLayout, TextField } from 'react-admin';

const UserShow = () => {
    return (
        <Show>
            <TabbedShowLayout>
                <TabbedShowLayout.Tab label="name">
                    <TextField source="name" label="Nome" />
                    <DateField source="created_at" label="Criando em" />
                </TabbedShowLayout.Tab>
                <TabbedShowLayout.Tab label="email">
                    <ReferenceManyField target="user_id" reference="emails">
                        <Datagrid bulkActionButtons={false}>
                            <TextField source="email" label="" />
                        </Datagrid>
                    </ReferenceManyField>
                </TabbedShowLayout.Tab>
                <TabbedShowLayout.Tab label="phone">
                    <ReferenceManyField target="user_id" reference="phones">
                        <Datagrid bulkActionButtons={false}>
                            <TextField source="number" label="" />
                        </Datagrid>
                    </ReferenceManyField>
                </TabbedShowLayout.Tab>
            </TabbedShowLayout>
        </Show>
    );
};

export default UserShow;