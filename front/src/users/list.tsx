import * as React from 'react';
import { Fragment, memo } from 'react';
import { List, Datagrid, TextField, DateField, SimpleList, useRecordContext, BulkDeleteButton, BulkExportButton, EditButton, ShowButton, TopToolbar, CreateButton, SearchInput, TextInput } from 'react-admin';

const UserActions = () => (
    <TopToolbar>
        <CreateButton />
    </TopToolbar>
);

export const UserList = () => (
    <List
        actions={<UserActions />}
    >
        <Datagrid
            bulkActionButtons={false}
        >
            <TextField source="id" />
            <TextField source="name" />
            <DateField source='updated_at' locales="pt-BR" />
            <EditButton />
            <ShowButton />
        </Datagrid>
    </List>
)