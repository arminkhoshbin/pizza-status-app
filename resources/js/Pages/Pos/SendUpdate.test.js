import { describe, it, expect } from 'vitest';
import SendUpdate from "./SendUpdate.vue";
import { router } from "@inertiajs/vue3";
import { fireEvent, render } from "@testing-library/vue";

vi.mock('@inertiajs/vue3', () => ({
  router: {
    post: vi.fn(),
  },
  Link: vi.fn(),
}));

const pageProps = {
  props: {
    flash: null,
  }
};

const order = {
  id: 1,
  name: 'pepperoni pizza',
};

describe('SendUpdate', () => {
  it('shows order name', () => {
    const { getByText } = render(SendUpdate, {
      props: {
        order: order,
        nextAvailableStatus: {
          status: 'making',
          label: 'making your pizza',
        },
      },
      global: {
        mocks: {
          $page: pageProps,
        },
      }
    });

    expect(getByText('Update status of the pepperoni pizza'));
  });

  it('shows completed order when there is no next available status', () => {
    const { getByText } = render(SendUpdate, {
      props: {
        order: order,
      },
      global: {
        mocks: {
          $page: pageProps,
        },
      }
    });

    expect(getByText('Your pepperoni pizza order is completed!'));
  });

  it('loads the button to change status of pizza', () => {
    const { getByRole } = render(SendUpdate, {
      props: {
        order: order,
        nextAvailableStatus: {
          status: 'making',
          label: 'Making the Pizza',
        },
      },
      global: {
        mocks: {
          $page: pageProps,
        },
      }
    });

    expect(getByRole('button', { name: 'Making the Pizza' })).toBeDefined();
  });

  it.each([
    ['Making the Pizza', 'making'],
    ['Pizza is in the oven', 'cooking'],
    ['Pizza is ready!', 'ready'],
  ])('makes a request to update status of the pizza', async (buttonLabel, status) => {
    const { getByRole } = render(SendUpdate, {
      props: {
        order: order,
        nextAvailableStatus: {
          status: status,
          label: buttonLabel,
        },
      },
      global: {
        mocks: {
          $page: pageProps,
        },
      }
    });

    await fireEvent.click(getByRole('button', { name: buttonLabel }));

    expect(router.post).toHaveBeenCalledWith(`/orders/${order.id}/send-update`, {
      status: status,
    }, expect.anything());
  });
});