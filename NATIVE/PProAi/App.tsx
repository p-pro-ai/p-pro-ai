import React from 'react';
import { NavigationContainer } from '@react-navigation/native';
import {createNativeStackNavigator} from '@react-navigation/native-stack';

import Login from './components/Login/Login';
import Register from './components/Register/Register';
import Verification_code from './components/Register/Verification';
import Dashboard from './components/Dashboard/Dashboard';
import GPT35 from './components/GPT35/GPT35';
import GPT4 from './components/GPT4/GPT4';
import TextGenerator from './components/HumanTextGenerator/HumanTextGenerator';
import Translator from './components/Translator/Translator';
import Math from './components/Math/Math';


const Stack = createNativeStackNavigator();

const App = () => {
    return (
        <NavigationContainer>
            <Stack.Navigator initialRouteName="Dashboard">
                <Stack.Screen name="Dashboard" component={Dashboard} />
                <Stack.Screen name="Verification_code" component={Verification_code} />
                <Stack.Screen name="Login" component={Login} />
                <Stack.Screen name="Register" component={Register} />
                <Stack.Screen name="ALLIN GPT 3.5" component={GPT35} />
                <Stack.Screen name="ALLIN GPT 4" component={GPT4} />
                <Stack.Screen name="Human text generator" component={TextGenerator} />
                <Stack.Screen name="ALLIN Translator" component={Translator} />
                <Stack.Screen name="ALLIN Math solver" component={Math} />
            </Stack.Navigator>
        </NavigationContainer>
    );
};

export default App;