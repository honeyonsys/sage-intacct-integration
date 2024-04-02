
# Sage Intacct Integration

## Prerequisites

- You must have a Web Services developer license, which includes a Web Services sender ID. If you need a developer license, contact your account manager.

- The company to which you will be sending API calls must [authorize your sender ID](https://developer.intacct.com/support/faq/#why-am-i-getting-an-error-about-an-invalid-web-services-authorization)

- You must have login credentials for the company, and it is strongly recommended that you use a Web Services user. See [Web Services users](https://www.intacct.com/ia/docs/en_US/help_action/Default.htm?_gl=1*1c0rrsj*_ga*MzU5OTg2NjkuMTcxMTU0MDE0OA..*_ga_HECRWGTVW8*MTcxMTk3NTQ3MC45LjEuMTcxMTk3NzExNC4wLjAuMA..#cshid=Web_services_users) in the Sage Intacct product help for details.


  ### How to retrieve the sender ID
      1. Sign in to your Sage Intacct account.
      2. From the Applications dropdown, click Company.
      3. Navigate to Setup > Configuration > Company > Security.
      4. From the Web services authorizations section, copy Sender ID.

  ### How to retrieve the web services user ID
      1. Sign in to your Sage Intacct account.
      2. From the Applications dropdown, click Company.
      3. Navigate to Admin > Web services users.
      4. From the Web services users list, copy the required User ID. If the web service user is not added, click Add. For more information on how to add a user, see Add a web services user.

  ### How to retrieve the company ID
      1. Sign in to your Sage Intacct account.
      2. From the Applications dropdown, click Company.
      3. Navigate to Setup > Configuration > Company > General information.
      4. From the Company Information section, copy ID.

  
