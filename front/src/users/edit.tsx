import {
    Card
} from '@mui/material';
import {
    ArrayInput,
    Edit,
    SimpleForm,
    SimpleFormIterator,
    TextInput,
    required
} from 'react-admin';


const UserEdit = () => {

    return (
        <Edit>
            <Card>
                <SimpleForm>
                    <TextInput
                        autoFocus
                        source="name"
                        label="Nome"
                        validate={required()}
                    />
                    <ArrayInput
                        source="phones"
                        label="Telefones"
                    >
                        <SimpleFormIterator>
                            <TextInput
                                source="number"
                                label="Número"
                                defaultValue=""
                                validate={required()}
                            />
                        </SimpleFormIterator>
                    </ArrayInput>
                    <ArrayInput
                        source="emails"
                        label="Emails"
                    >
                        <SimpleFormIterator>
                            <TextInput
                                source="email"
                                defaultValue=""
                                validate={required()}
                            />
                        </SimpleFormIterator>
                    </ArrayInput>
                </SimpleForm>
            </Card>
        </Edit>
    );
};

export default UserEdit;