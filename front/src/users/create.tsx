import { useMemo } from 'react';
import {
    ArrayInput,
    Create,
    SaveButton,
    SimpleFormConfigurable,
    SimpleFormIterator,
    TextInput,
    Toolbar,
    required
} from 'react-admin';

const UserCreateToolbar = () => {
    return (
        <Toolbar>
            <SaveButton label="Salvar" variant="text" />
        </Toolbar>
    );
};


const UserCreate = () => {
    return (
        <Create redirect="edit">
            <SimpleFormConfigurable
                toolbar={<UserCreateToolbar />}
            >
                <TextInput
                    autoFocus
                    source="name"
                    label="Nome"
                    validate={required('Required field')}
                />
                <ArrayInput
                    source="phones"
                    label="Telefones"
                    validate={[required()]}
                >
                    <SimpleFormIterator>
                        <TextInput
                            source="phone"
                            defaultValue=""
                        />
                    </SimpleFormIterator>
                </ArrayInput>
                <ArrayInput
                    source="emails"
                    label="Emails"
                    validate={[required()]}
                >
                    <SimpleFormIterator>
                        <TextInput
                            source="email"
                            defaultValue=""
                        />
                    </SimpleFormIterator>
                </ArrayInput>
            </SimpleFormConfigurable>
        </Create>
    );
};

export default UserCreate;