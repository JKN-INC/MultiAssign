# MultiAssign

ILIAS UserInterfaceHook-Plugin with the following featues:  
- Add a User so one or more courses  
- Send a Summary-Email

## Clients

All Clients use this.

# Installation
Start at your ILIAS root directory  
```bash
mkdir -p Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/  
cd Customizing/global/plugins/Services/UIComponent/UserInterfaceHook/  
git clone git@github.com:JKN-INC/MultiAssign.git
```  
As ILIAS administrator go to "Administration->Plugins" and install/activate the plugin.  

## Usage

An additional Button on the Personal Desktop of users having a given role leads to the Multi-Assign-Overview. On the overview-page the User can search for a specific user-account. After selecting the account the user is able to assign this account to multiple courses in different roles (Administrator/Tutor/Member). The selected user receives a summary-email.  
![001][pd]
![002][user_select]
![003][assign]
Have a look at the [full documentation](/doc/Documentation.pdf?raw=true)


[pd]: /doc/Screenshots/001.png?raw=true "personal desktop"
[user_select]: /doc/Screenshots/002.png?raw=true "Select Users"
[assign]: /doc/Screenshots/003.png?raw=true "Assign User to multiple Courses"
[conf]: /doc/Screenshots/004.png?raw=true "Plugin-Configuration"


## Other Info

This was developed by fluxlabs and eventually abandoned.